# National Minimum Data Set for Social Care (NMDS-SC)

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

To log into Cloud Foundry vis the CLI to manage services, you can use the following command:

<code>cf login</code>

You will then be prompted to enter your credentials

### Deploy code to the platform

To deploy/push an application to the platform, the following command can be used, using the development environment as an example:

<code>cf push nmds-sc-v2-development</code>

Ideally, you should be on the corresponding branch in Github. The command will push the app to the service, perform any Composer installs, database migrations and database seeds.

The command will give visual output so you can observe the process.

### SSH and running Artisan commands

In order to run the php command with SSH for a Cloud Foundry app

<code>cf ssh appname -t -c "/tmp/lifecycle/launcher /home/vcap/app bash ''"</code>

So if you wanted to do it on the development environment, the command would be:

<code>cf ssh nmds-sc-v2-development -t -c "/tmp/lifecycle/launcher /home/vcap/app bash ''"</code>
