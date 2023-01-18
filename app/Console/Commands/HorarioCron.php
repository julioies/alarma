<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Cancion;
use App\Models\Horario;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Console\Scheduling\Schedule;





class ShellCommand
{
    public static function execute($cmd): string
    {
        $process = Process::fromShellCommandline($cmd);

        $processOutput = '';

        $captureOutput = function ($type, $line) use (&$processOutput) {
            $processOutput .= $line;
        };

        $process->setTimeout(null)
            ->run($captureOutput);

        if ($process->getExitCode()) {
            $exception = new ShellCommandFailedException($cmd . " - " . $processOutput);
            report($exception);

            throw $exception;
        }

        return $processOutput;
    }
}

class HorarioCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Horario:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // $horaActual = date('H'); // obtiene la hora actual en formato horas:minutos:segundos (por ejemplo, "15:34:21")
        // $diaSemana = date('N'); // obtiene el nombre del día de la semana actual (por ejemplo, "Monday")
        // $minutosActuales = date('i'); // obtiene los minutos actuales (por ejemplo, "34")

        // echo $horaActual;
        // echo $diaSemana;
        // echo $minutosActuales;

        $canciones = [];
        $canciones[0] = 0;
        $canciones[1] = Cancion::whereNum(1)->get();
        $canciones[2] = Cancion::whereNum(2)->get();
        $canciones[3] = Cancion::whereNum(3)->get();
        $canciones[4] = Cancion::whereNum(4)->get();

        $horariosEscolares = Horario::get();


        foreach ($horariosEscolares as $horarioEscolar) {
            $time = $horarioEscolar->hora;
            $time = explode(":", $time);
            $hora = $time[0];
            $minuto = $time[1];

            echo date('H') . "-" . $hora . "<->" . date('i') . "-" . $minuto . "<br>";

            if (date('H') == $hora && date('i') == $minuto) {

                switch (date('N')) { //dia semana (lunes->1, martes->2...)
                    case '1':
                        $lunes = $horarioEscolar->lunes;
                        if ($lunes != 0 && !($canciones[$lunes]->isEmpty())) {
                            info("Lunes -Reproduciendo Cancion " . $canciones[$lunes]->toArray()[0]["nombre"] . " " . Now());
                            system('mpg123 -q /var/www/html/alarma/storage/app/canciones/'.$canciones[$lunes][0]->nombre);
                        }
                        info("Entra Lunes");
                        break;
                    case '2':
                        $martes = $horarioEscolar->martes;
                        if ($martes != 0 && !($canciones[$martes]->isEmpty())) {
                            info("Martes -Reproduciendo Cancion " . $canciones[$martes]->toArray()[0]["nombre"] . " " . Now());
                            //info("sh /var/www/html/alarma/storage/app/canciones/reproductor.sh ".$canciones[$martes][0]->nombre."");

                            system('mpg123 -q /var/www/html/alarma/storage/app/canciones/'.$canciones[$martes][0]->nombre);
                           // info('mpg123 -q -k 0 -n 15 /var/www/html/alarma/storage/app/canciones/'.$canciones[$martes][0]->nombre.' &');
                        }
                        info("Entra Martes");

                        break;
                    case '3':
                        $miercoles = $horarioEscolar->miercoles;
                        if ($miercoles != 0 && !($canciones[$miercoles]->isEmpty())) {
                            info("Miercoles -Reproduciendo Cancion " . $canciones[$miercoles]->toArray()[0]["nombre"] . " " . Now());
                            system('mpg123 -q /var/www/html/alarma/storage/app/canciones/'.$canciones[$miercoles][0]->nombre);
                        }
                        info("Entra Miercoles");
                        break;
                    case '4':
                        $jueves = $horarioEscolar->jueves;
                        if ($jueves != 0 && !($canciones[$jueves]->isEmpty())) {
                            info("Jueves -Reproduciendo Cancion " . $canciones[$jueves]->toArray()[0]["nombre"] . " " . Now());
                            system('mpg123 -q /var/www/html/alarma/storage/app/canciones/'.$canciones[$jueves][0]->nombre);

                        }
                        info("Entra Jueves");
                        break;
                    case '5':
                        $viernes = $horarioEscolar->viernes;
                        if ($viernes != 0 && !($canciones[$viernes]->isEmpty())) {
                            info("Viernes -Reproduciendo Cancion " . $canciones[$viernes]->toArray()[0]["nombre"] . " " . Now());
                            system('mpg123 -q /var/www/html/alarma/storage/app/canciones/'.$canciones[$viernes][0]->nombre);

                        }
                        info("Entra Viernes");
                        break;
                }
            }
            info("Entra Final");
            //system('mpg123 -q -k 0 -n 15 /var/www/html/alarma/storage/app/canciones/quevedo.mp3 &');
            //system('mpg123 -q /var/www/html/alarma/storage/app/canciones/quevedo.mp3 &');
            //system('nvlc --run-time=15 /var/www/html/alarma/storage/app/canciones/quevedo.mp3 &');


            //$process = new Process(['sh /home/pc/Escritorio/reproduce.sh', '/home/pc/Escritorio/alarma/storage/app/canciones/quevedo.mp3']);
             //$process->run();
            // system('mpg123 -q /home/pc/Escritorio/alarma/storage/app/canciones/quevedo.mp3 &');


            // // executes after the command finishes
            // if (!$process->isSuccessful()) {
            //     throw new ProcessFailedException($process);
            // }
            // echo $process->getOutput();
        //ShellCommand::execute("nvlc /home/pc/Escritorio/alarma/storage/app/canciones/quevedo.mp3");
        // $process = new Process(["nvlc","/home/pc/Escritorio/alarma/storage/app/canciones/quevedo.mp3"]);
        // $process->run();
        // $exitCode->run();

        // if ($exitCode !== 0) {
        //    info("FALLO EN MATRIX");
        // }
        //$process = new Process(["app/Console/Commands/reproduce.sh","app/Console/Commands/quevedo.mp3"]);
        //$process->run();
       // $exitCode = Process::run("app/Console/Commands/reproduce.sh app/Console/Commands/quevedo.mp3");



        // return Command::SUCCESS;
        }

        return Command::SUCCESS;
    }
}
