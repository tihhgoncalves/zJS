<?php namespace Zjs;

use Carbon\Carbon;
use \Symfony\Component\Console\Input\ArgvInput;
use Bugotech\IO\Filesystem;

class Builder
{
    const version = '1.0.0';

    /**
     * @var ArgvInput
     */
    protected $input;

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * Path root do zJS.
     * @var string
     */
    protected $pathBase = '';

    /**
     * @param $path
     * @param $in
     * @param $out
     */
    public function __construct($pathBase, ArgvInput $input)
    {
        $this->files = new Filesystem();
        $this->pathBase = $pathBase;
        $this->input    = $input;

        // Verificar se deve ativar o log
        if ($input->getOption('log')) {
            ini_set('error_log', $this->files->combine($this->pathBase, 'log.txt'));
        }
    }

    /**
     * Montar arquivos.
     * @return bool
     */
    public function make()
    {
        $index = $this->getIndex();
        $files = [];

        // Carregar buffers
        foreach ($index->files as $file) {
            $file_full = $this->files->combine($index->path, $file);
            $files[$file] = trim($this->files->get($file_full));
        }

        // Juntar buffers
        $buffer  = "/**\r\n";
        $buffer .= " * ZJS " . self::version . "\r\n";
        $buffer .= " * Date: " . Carbon::now()->format('Y-m-d H:i:s') . "\r\n";
        $buffer .= " */\r\n";

        foreach ($files as $name => $code) {
            $buffer .= "\r\n/*---  " . strtoupper($name) . "  ---*/\r\n";
            $buffer .= $code . "\r\n";
        }

        // Gerar arquivo out
        $out_file = $this->files->combine($index->path, $this->input->getArgument('out'));
        if ($this->files->exists($out_file)) {
            $this->files->delete($out_file);
        }

        $dir = $this->files->path($out_file);
        $this->files->force($dir);

        $buffer = trim($buffer);
        $this->files->put($out_file, $buffer);

        // Verificar se deve minificar
        if ($this->input->getOption('minify')) {
            $ext = $this->files->extension($out_file);
            $out_file_min = str_replace('.' . $ext, '.min.' . $ext, $out_file);
            $buffer_min = JSMin::minify($buffer);

            if ($this->files->exists($out_file_min)) {
                $this->files->delete($out_file_min);
            }

            $this->files->put($out_file_min, $buffer_min);
        }

        return true;
    }

    /**
     * Retorna a definição em index.zjs (JSON).
     * @return \stdClass
     * @throws \Exception
     */
    protected function getIndex()
    {
        $projeto_path = $this->input->getArgument('path');
        $file_index = $this->input->getArgument('in');

        if (is_null($file_index)) {
            throw new \Exception('Arquivo root.zjs nao foi informado');
        }

        // Carregar arquivo index.zjs
        $file_index = $this->files->combine($projeto_path, $file_index);
        if (! $this->files->exists($file_index)) {
            throw new \Exception(sprintf('Arquivo root "%s" nao foi encontrado', $file_index));
        }

        // Carregar arquivo e traduz em objeto JSON
        $obj = json_decode($this->files->get($file_index));
        $obj->path = $projeto_path;
        $obj->config_file = $file_index;

        // Validar
        if ((! isset($obj->files)) || (! is_array($obj->files))) {
            throw new \Exception('Arquivo root.zjs esta incorreto. Lista de arquivos nao foi definida.');
        }

        return $obj;
    }
}