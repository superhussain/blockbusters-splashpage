<?php

// Question Submit

header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=\"responses.txt\"");

class Submit_Question {
  function __construct($data) {
    $this->name = stripslashes($data['name']);
    $this->team = stripslashes($data['team']);
    $this->question = stripslashes($data['question']);
    $this->answer = stripslashes($data['answer']);

    $this->response_status = 1;
    $this->response_html = '';
  }

  private function validateFields() {
    if(!$this->name) {
      $this->response_html .= '<p>Please enter your name.</p>';
      $this->response_status = 0;
    }

    if (!$this->team) {
      $this->team = 'NONE';
    }

    if(!$this->question) {
      $this->response_html .= '<p>Please enter your question.</p>';
      $this->response_status = 0;
    }

    if(!$this->answer) {
      $this->response_html .= '<p>Please enter your answer.</p>';
      $this->response_status = 0;
    }
  }

  private function writeFile() {
    // this function will write data to a file
    date_default_timezone_set('America/Toronto');
    $this->date = date('m/d/Y h:i:s a', time());

    $this->txt = $this->date . "\t" . $this->name . "\t" . $this->team . "\t" . $this->question . "\t" . $this->answer;

    $myfile = fopen("responses.txt", "a") or die("Unable to open file!");
    fwrite($myfile, "\n". $this->txt);
    fclose($myfile);

    $this->response_status = 1;
    $this->response_html = '<p>Thank You! We have received your entry!</p>';
  }

  function sendRequest() {
    $this->validateFields();
    if ($this->response_status) {
      $this->writeFile();
    }

    $response = array();
    $response['status'] = $this->response_status;
    $response['html'] = $this->response_html;

    echo json_encode($response);
  }
}

$submit_question = new Submit_Question($_POST);
$submit_question->sendRequest();

?>
