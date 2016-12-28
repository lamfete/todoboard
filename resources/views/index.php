<!DOCTYPE html>
<html ng-app='todoApp'>
    <head>
        <!--<meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1">-->
        <title>Todo Board</title>
        <!--<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">-->

        <!-- Angular Material style sheet -->
        <link rel="stylesheet" href="/node_modules/angular-material/angular-material.css">
        <meta name="viewport" content="initial-scale=1" />
    </head>
    <body layout="column" ng-controller="appCtrl">
        <md-toolbar layout="row">
            <div class="md-toolbar-tools">
                <md-button ng-click="toggleSidenav('left')" hide-gt-sm class="md-icon-button">
                    <md-icon aria-label="Menu" md-svg-icon="css/material-design-icons/navigation/svg/production/ic_menu_48px.svg" class="avatar"></md-icon>
                </md-button>
                <h1>Todo Board</h1>
            </div>
        </md-toolbar>

        <div layout="row" flex>
            <md-sidenav layout="column" class="md-sidenav-left md-whiteframe-4dp" md-component-id="left" md-is-locked-open="$mdMedia('gt-sm')">
                <ul>
                    <li>
                        <md-button>
                            <md-icon md-svg-src="node_modules/material-design-icons/action/svg/production/ic_android_48px.svg" class="avatar"></md-icon>
                            Riki Sholiardi
                        </md-button>
                    </li>
                    <li>
                        <md-button>
                            <md-icon md-svg-src="css/material-design-icons/action/svg/production/ic_pets_48px.svg" class="avatar"></md-icon>
                            Udin Khouiruddin
                        </md-button>
                    </li>
                </ul>
            </md-sidenav>

            <md-content layout="column" flex class="md-padding">
                <div ui-view></div>
                content
            </md-content>
        </div>

    </body>

    <!-- Application dependencies -->
    <script src="node_modules/angular/angular.js"></script>
    <script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="node_modules/satellizer/dist/satellizer.js"></script>

    <!-- Application scripts -->
    <script src="scripts/app.js"></script>
    <script src="scripts/authController.js"></script>
    <script src="scripts/todoController.js"></script>

    <!-- Angular Material requires Angular.js Libraries -->
    <script src="node_modules/angular-animate/angular-animate.js"></script>
    <script src="node_modules/angular-aria/angular-aria.js"></script>

    <!-- Angular Material Library -->
    <script src="node_modules/angular-material/angular-material.js"></script>
</html>
