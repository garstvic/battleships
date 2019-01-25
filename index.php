<?php

require_once __DIR__.'/bootstrap.php';

use Model\BrokenShip;
use Service\Container;
use Service\BattleManager;

$container = new Container($configuration);
$shipLoader = $container->getShipLoader();
$ships = $shipLoader->getShips();

$brokenShip = new BrokenShip('Broken Ship');
$ships[] = $brokenShip;

$ships->removeAllBrokenShips();

$battleTypes = BattleManager::getAllBattleTypesWithDescription();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Don\'t forget to select some ships to battle!';
            break;
        case 'bad_ships':
            $errorMessage = 'You\'re trying to fight with a ship that\'s unknown to the galaxy?';
            break;
        case 'bad_quantities':
            $errorMessage = 'You pick strange numbers of ships to battle - try again.';
            break;
        default:
            $errorMessage = 'There was a disturbance in the force. Try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OO Battleships</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
</head>
<?php if ($errorMessage): ?>
    <div>
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>
<body>
    <div class="container">
        <div class="page-header">
            <h1>OO Battleships of Space</h1>
        </div> 
        <table class="table table-hover">
            <caption><i class="fa fa-rocket"> These ships are ready for their next Mission</i></caption>
            <thead>
                <tr>
                    <th>Ship</th>
                    <th>Weapon Power</th>
                    <th>Jedi Factor</th>
                    <th>Strength</th>
                    <th>Status</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ships as $ship): ?>
                    <tr>
                        <td><?php echo $ship->getName(); ?></td>
                        <td><?php echo $ship->getWeaponPower(); ?></td>
                        <td><?php echo $ship->getJediFactor(); ?></td>
                        <td><?php echo $ship->getStrength(); ?></td>
                        <td><i class="fa <?php echo $ship->isFunctional() ? 'fa-sun-o' : 'fa-cloud'; ?>"></i></td>
                        <td><?php echo $ship->getType(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="battle-box center-block border">
            <div>
                <form method="post" action="/battle.php">
                    <h2 class="text-center">The Mission</h2>
                    <input class="center-block form-control text-field" type="text" name="ship1_quantity" placeholder="Enter Number of Ships" />
                    <select name="ship1_id" id="ship1_id" class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle">
                        <option value="">Choose a Ship</option>
                        <?php foreach ($ships as $ship): ?>
                            <?php if ($ship->isFunctional()): ?>
                                <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <p class="text-center">AGAINST</p>
                    <br />
                    <input type="text" class="center-block form-control text-field" name="ship2_quantity" placeholder="Enter Number of Ships">
                    <select name="ship2_id" id="ship2_id" class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle">
                        <option value="">Choose a Ship</option>
                        <?php foreach ($ships as $ship): ?>
                            <?php if ($ship->isFunctional()): ?>
                                <option value="<?php echo $ship->getId(); ?>"><?php echo $ship->getNameAndSpecs(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <div class="text-center">
                        <label for="battle_type">Battle Type</label>
                        <select name="battle_type" id="battle_type" class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle">
                            <?php foreach ($battleTypes as $battleType => $typeText): ?>
                                <option value="<?php echo $battleType; ?>"><?php echo $typeText; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br />
                    <button class="btn btn-md btn-danger center-block" type="submit">Engage</button>
                </form>
            </div>
        </div>
    </div>     
</body>        
</html>
