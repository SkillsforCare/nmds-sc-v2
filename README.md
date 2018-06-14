# National Minimum Data Set for Social Care (NMDS-SC)

This project is to support the Alpha development of the NMDS-SC V2. It is written using Laravel 5.6 and Vue.js. At the time of writing, it is using GOV.UK Elements and the Front-end Toolkit for the front-end.

These notes are provided as a guide to get a potential developer setup with the project. Teams are welcome to develop their own development strategy and workflows for the project.

## Installation

One thing to note about the setup is that it is different from a typical Laravel project. This is to support deployments with Cloud Foundry (see below). 
The main Laravel project sits in the `htdocs` directory.

Once the repository has been cloned, please checkout the `development` branch using your Git tool (for information about environments, see the Environment section below).

Within the `htdocs` folder, make a copy the `.env.example` and rename it `.env`. Edit the `.env` file as needed. Most importantly, setup the database for your local development.

Next, return to the root of the project on the command line and run:

`composer install`

This will install the project dependencies and seed your database with test data.

### Compiling assets

Assets (Javascript/Vue and SCSS/CSS) are transpiled using Laravel Mix and Webpack. The output is stored in `htdocs\public` and committed into version control. If you need to change the CSS and Javascript, the source is in the `htdocs\resources\assets` directory. 

First, the npm dependencies need to be installed for the project. You can do so by running the following command in the `htdocs` directory:

`npm install`

If you make any changes, you can compile the assets by moving into the `htdocs` directory and running the following commands:

`npm run dev` This will build your assets for development.

`npm run watch` As BrowserSync is enabled, you can view changes in the browser while you make changes to your CSS or Javascript.

`npm run production` This will compile and minify your assets, useful if deploying to he production environment.

### Running tests

The project includes some Laravel Dusk and HTTP Feature and Unit tests.

As we have seed data, we use the Database Transactions trait when running the tests. However, if needed, the model factories can be used.

Run the following commands:

`php artisan dusk` This will run the front-end tests.

`phpunit` or `vendor\bin\phpunit` (depending on your setup). This will run the feature and unit tests.

Ideally, all the tests should pass while developing a feature.

### Refreshing and seeding the database

If at any point you need to refresh the database, you can run the command:

`php artisan migrate:fresh --seed`

This will refresh and re-seed the database. This is useful when you have been physically testing the front-end and you want to return the database to its initial state.

When a `composer` command is run and completes, it automatically runs the `php artisan database:migrate-environment` command. It is also run when an application is deployed. This performs migrations and seeds based on the current environment.

As development occurs, this can be changed to only provide seeds for certain environments

### Environments

There are three main environments in the project that correspond to the Cloud Foundry applications. The deploy command is also included. The information is below.

| Git branch | Cloud Foundry App | Deploy command |
| ------------- |-------------|---|
| development   | nmds-sc-v2-development | cf push nmds-sc-v2-development |
| uat      | nmds-sc-v2-uat      | cf push nmds-sc-v2-uat |
| alpha | nmds-sc-v2-alpha      | cf push nmds-sc-v2-alpha |
| master | Not in use yet. Expected to be the final production environment | n/a |


### Branching strategy and feature development

When a new feature begins development, it is expected that a new branch is created from the `development` branch and initialised as a pull request in version control.

A TDD approach is recommended. A series of tests should then be written that matches the acceptance criteria of the feature and then code written to make these tests pass.

Once complete, it can be then merged and deployed onto `uat` so that internal or external users can verify the acceptance criteria of the feature.

Then once the tests and user acceptance is verified as working as expected on UAT, it can then be pushed to the `alpha` site.

## Preparing for a release



## Server management

### Cloud Foundry

Cloud Foundry is used to deploy applications to the GOV.UK PaaS.

Guidance from the GOV.UK PaaS team can be found here:

https://docs.cloud.service.gov.uk

The login for the administration:

https://login.cloud.service.gov.uk/login

It is highly recommended that you install the command line tool to perform the various operations with your applications:

https://docs.cloud.service.gov.uk/#set-up-command-line

### Logging in

If you are reposnsible for deploying applications, then please obtain login credentials from one of the administrators of the Cloud Foundry service

To log into Cloud Foundry vis the CLI to manage services, you can use the following command:

`cf login`

You will then be prompted to enter your credentials

### Deploy code to the platform

To deploy/push an application to the platform, the following command can be used, using the development environment as an example. For details about environments, see the Environments section above:

`cf push nmds-sc-v2-development`

Ideally, you should be on the corresponding branch in Github relating to the environment that you want to push. The command will push the app to the service, perform any Composer installs, database migrations and database seeds.

The command will give visual output so you can observe the process.

### SSH and running Artisan commands

In order to run the php command with SSH for a Cloud Foundry app

`cf ssh appname -t -c "/tmp/lifecycle/launcher /home/vcap/app bash ''"`

So if you wanted to do it on the development environment, the command would be:

`cf ssh nmds-sc-v2-development -t -c "/tmp/lifecycle/launcher /home/vcap/app bash ''"`

## Contributing

At this stage, the project is still under development and doesn't have a contribution strategy in place. However, the project is not closed to ideas! Please open an issue in:

https://github.com/SkillsforCare/nmds-sc-v2/issues

to start a conversation! All feedback is welcome and is helpful in developing the project. 

## License

The National Minimum Data Set for Social Care (NMDS-SC) is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).