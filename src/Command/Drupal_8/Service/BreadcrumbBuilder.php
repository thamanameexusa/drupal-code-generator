<?php

namespace DrupalCodeGenerator\Command\Drupal_8\Service;

use DrupalCodeGenerator\Command\BaseGenerator;
use DrupalCodeGenerator\Utils;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

/**
 * Implements d8:service:breadcrumb-builder command.
 */
class BreadcrumbBuilder extends BaseGenerator {

  protected $name = 'd8:service:breadcrumb-builder';
  protected $description = 'Generates a breadcrumb builder service';
  protected $alias = 'breadcrumb-builder';

  /**
   * {@inheritdoc}
   */
  protected function interact(InputInterface $input, OutputInterface $output) {
    $questions = Utils::defaultQuestions();
    $default_class = function ($vars) {
      return Utils::camelize($vars['name'] . 'BreadcrumbBuilder');
    };
    $questions['class'] = new Question('Class', $default_class);

    $vars = $this->collectVars($input, $output, $questions);

    $path = 'src/' . $vars['class'] . '.php';
    $this->setFile($path, 'd8/service/breadcrumb-builder.twig', $vars);
    $this->setServicesFile($vars['machine_name'] . '.services.yml', 'd8/service/breadcrumb-builder.services.twig', $vars);
  }

}
