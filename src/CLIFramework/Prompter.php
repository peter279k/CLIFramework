<?php
namespace CLIFramework;
use CLIFramework\Formatter;


/**
 * Prompter class
 *
 *
 *
 */
class Prompter
{

    public $style;
    public $formatter;

    public function __construct()
    {
        $this->formatter = new Formatter;
    }

    /**
     * set prompt style
     */
    public function setStyle($style)
    {
        return $this->style = $style;
    }


    /**
     * show prompt with message
     */
    public function ask($prompt, $validAnswers = null )
    {
        if( $validAnswers ) {
            $prompt .= ' [' . join('/',$validAnswers) . ']';
        }
        $prompt .= ': ';

        if( $this->style ) {
            echo $this->formatter->getStartMark( $this->style );
            // $prompt = $this->formatter->getStartMark( $this->style ) . $prompt . $this->formatter->getClearMark();
        }

        $answer = null;
        while(1) {
            if( extension_loaded('readline') ) {
                $answer = readline($prompt);
                readline_add_history($answer);
            } else {
                echo $prompt;
                $answer = rtrim( fgets( STDIN ), "\n" );
            }
            $answer = trim( $answer );
            if( $validAnswers ) {
                if( in_array($answer,$validAnswers) ) {
                    echo $this->formatter->getClearMark();
                    break;
                } else {
                    continue;
                }
            }
            break;
        }
        return $answer;
    }
}
