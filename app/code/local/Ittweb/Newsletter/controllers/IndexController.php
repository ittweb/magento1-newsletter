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
      $this->setResponse(500, "JSON error: $jsonReceived");
    }

    try {
      Mage::getModel('newsletter/subscriber')->subscribe($jsonReceived['email']);
      return $this->setResponse(200, 'Subscribed correctly');
    } catch (Exception $e) {
      return $this->setResponse(500, 'Error on the subscription: please check the log', $e);
    }
  }

  public function checkAction()
  {
    $jsonReceived = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $this->setResponse(500, "JSON error: $jsonReceived");
    }

    $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($jsonReceived['email']);
    if ($subscriber->getStatus() === '1') {
      return $this->setResponse(200, 'Ok');
    } else {
      return $this->setResponse(501, 'Email is not subscribed');
    }
  }

  public function unsubscribeAction()
  {
    $jsonReceived = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      $this->setResponse(500, "JSON error: $jsonReceived");
    }

    try {
      Mage::getModel('newsletter/subscriber')->loadByEmail($jsonReceived['email'])->unsubscribe();
      return $this->setResponse(200, 'Unsubscribed correctly');
    } catch (Exception $e) {
      return $this->setResponse(500, 'Error on unsubscribe: please check the log', $e);
    }
  }
}
