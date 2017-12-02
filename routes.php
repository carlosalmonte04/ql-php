<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'energy_consumptions':
        // we need the model to query the database later in the controller
        $controller = new EnergyConsumptionsController();
      break;
      case 'sessions':
        $controller = new SessionsController();
        break;
      case 'users';
        $controller = new UsersController();
        break;
    }

    $controller->{ $action }();
  }

  // we're adding an entry for the new controller and its actions
  $controllers = array('pages' => ['home', 'error', 'dashboard'],
                       'energy_consumptions' => ['index', 'show'],
                       'sessions' => ['create', 'store'],
                       'users' => ['create', 'store']
                     );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>