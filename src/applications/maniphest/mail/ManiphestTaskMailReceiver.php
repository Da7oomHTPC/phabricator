<?php

final class ManiphestTaskMailReceiver extends PhabricatorObjectMailReceiver {

  public function isEnabled() {
    $app_class = 'PhabricatorApplicationManiphest';
    return PhabricatorApplication::isClassInstalled($app_class);
  }

  protected function getObjectPattern() {
    return 'T[1-9]\d*';
  }

  protected function loadObject($pattern, PhabricatorUser $viewer) {
    $id = (int)trim($pattern, 'T');

    $results = id(new ManiphestTaskQuery())
      ->setViewer($viewer)
      ->withTaskIDs(array($id))
      ->execute();

    return head($results);
  }

}
