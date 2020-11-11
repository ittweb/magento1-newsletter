<?php
class Ittweb_Newsletter_IndexController extends Mage_Core_Controller_Front_Action
{
  private function setResponse($statusCode, $msg = '', $log = '')
  {
    $this->getResponse()
      ->setHeader('HTTP/1.0', $statusCode, true)
      ->setBody($msg);

    if ($log) {
      Mage::helper("ittweb_newsletter")->log("$msg - $log");
    }
  }

  public function subscribeAction()
  {
    $jsonReceived = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $this->setResponse(500, "JSON mal formattato: $jsonReceived");
    }

    try {
      Mage::getModel('newsletter/subscriber')->subscribe($jsonReceived['email']);
      return $this->setResponse(200, 'Iscritto correttamente');
    } catch (Exception $e) {
      return $this->setResponse(500, 'Errore in fase di iscrizione: verifica i log', $e);
    }
  }

  public function checkAction()
  {
    $jsonReceived = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $this->setResponse(500, "JSON mal formattato: $jsonReceived");
    }

    $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($jsonReceived['email']);
    if ($subscriber->getStatus() === '1') {
      return $this->setResponse(200, 'Ok');
    } else {
      return $this->setResponse(501, 'Email non presente');
    }
  }

  public function unsubscribeAction()
  {
    $jsonReceived = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $this->setResponse(500, "JSON mal formattato: $jsonReceived");
    }

    try {
      Mage::getModel('newsletter/subscriber')->loadByEmail($jsonReceived['email'])->unsubscribe();
      return $this->setResponse(200, 'Disiscritto correttamente');
    } catch (Exception $e) {
      return $this->setResponse(500, 'Errore in fase di disiscrizione: verifica i log', $e);
    }
  }
}
