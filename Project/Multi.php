<?php

namespace Project;

use Symfony\Component\Process\Process;

class Multi
{
    private array $pullProcess;

    public function __construct(array $scripts, ?callable $callBackFunction = null)
    {
        foreach($scripts as $script){
            $this->initProcess($script, $callBackFunction);
        }

        while(true){
            $this->cheakFinish();
        }
    }

    public function initProcess($script, ?callable $callBackFunction = null) : Process
    {
        $process = new Process(['php', $script]);
        $process->start($callBackFunction);
        $this->pullProcess[$process->getPid(). ":" .$script] = $process;

        return $process;
    }

    private function cheakFinish(): void
    {
        if(empty($this->pullProcess)){
            return;
        }

        foreach ($this->pullProcess as $nameProcess => $process){
            if($process instanceof Process && $process->isTerminated()){
                unset($this->pullProcess[$nameProcess]);
            }
        }
    }
}