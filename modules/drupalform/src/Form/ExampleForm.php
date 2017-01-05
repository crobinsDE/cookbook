<?php

/**
 * @file
 * Contains \Drupal\drupalform\Form\ExampleForm.
 */

 namespace Drupal\drupalform\Form;

 use Drupal\Core\Form\ConfigFormBase;
 use Drupal\Core\Form\FormStateInterface;

 class ExampleForm extends ConfigFormBase {

   /**
    * {@inheritdoc}
    */
   protected function getEditableConfigNames() {
     return ['drupalform.company'];
   }

   /**
    * {@inheritdoc}
    */
   public function getFormId() {
     return 'drupalform_example_form';
   }

   /**
    * {@inheritdoc}
    */
   public function buildForm(array $form, FormStateInterface $form_state) {
     // Return array of Form API elements
     $form['company_name'] = array(
       '#type' => 'textfield',
       '#title' => $this->t('Company name'),
       '#default_value' => $this->config('drupalform.company')->get('name'),
     );
    //  $form['phone'] = array(
    //    '#type' => 'tel',
    //    '#title' => t('Phone'),
    //  );
    //  $form['email'] = array(
    //    '#type' => 'email',
    //    '#title' => t('Email'),
    //  );
    //  $form['integer'] = array(
    //    '#type' => 'number',
    //    '#title' => t('Some integer'),
    //    // The increment or decrement amount
    //    '#step' => 1,
    //    // Minimum allowed value
    //    '#min' => 0,
    //    // Maximum allowed value
    //    '#max' => 100,
    //  );
    //  $form['date'] = array(
    //    '#type' => 'date',
    //    '#title' => t('Date'),
    //    '#date_timeformat' => 'Y-m-d',
    //  );
    //  $form['website'] = array(
    //    '#type' => 'url',
    //    '#title' => t('Website'),
    //  );
    //  $form['search'] = array(
    //    '#type' => 'search',
    //    '#title' => t('Search'),
    //    '#autocomplete_route_name' => FALSE,
    //  );
    //  $form['range'] = array(
    //    '#type' => 'range',
    //    '#title' => t('Range'),
    //    '#min' => 0,
    //    '#max' => 100,
    //    '#step' => 1,
    //  );
    //  $form_state->setValidateHandlers([
    //    ['::validateForm'],
    //    ['::method1'],
    //    [$this, 'method2'],
    //  ]);
     return parent::buildForm($form, $form_state);
   }

   /**
    * {@inheritdoc}
    */
   public function validateForm(array &$form, FormStateInterface $form_state) {
     // Validation covered in later recipe, required to satisfy interface
     if (!$form_state->isValueEmpty('company_name')) {
       // Value is set, perform validation
       if (strlen($form_state->getValue('company_name')) <= 5) {
         // Set validation error.
         $form_state->setErrorByName('company_name', t('Company name is less than 5 characters'));
       }
     }
   }

   /**
    *
    */
   public function submitForm(array &$form, FormStateInterface $form_state) {
     // Validation covered in later recipe, required to satisfy interface
     parent::submitForm($form, $form_state);
     $this->config('drupalform.company')
      ->set('name', $form_state->getValue('company_name'));
   }
 }

?>
