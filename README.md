TaxfileIntage
========================

Welcome to TaxfileIntage 
For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

Installation ?
--------------
 
  Installaion FTP server:
  * [**Ftp aws**][14]
  
  Installaion FTP Client  and configuration: 
  * [**Ftp Client**][15]
  * [**Ftp  permission denied**][16]
  
  The Php7 is configured with the following description:
  
      # Remove current php & apache
      sudo service httpd stop
      sudo yum remove httpd* php* 
      
      # Remove any third party repos that aren't relevant
      sudo yum repolist
      sudo yum remove remi-safe
      
      # Install Standard Apache for Amazon AMI
      sudo yum install httpd   #specify http22 if you get a different version
      
      # Download webtatic
      mkdir -p /tmp/php7
      cd /tmp/php7
      wget https://mirror.webtatic.com/yum/el6/latest.rpm
      
      # Install webtatic repo
      sudo yum install latest.rpm
      sudo vi /etc/yum.repos.d/webtatic.repo  'set repo enables
      sudo yum clean all
      
      # Install base php7
      sudo yum install --enablerepo=webtatic php70w
      php -v   #Should say something like  PHP 7.0.2 (cli) (built: Jan  9 2016 16:09:32) ( NTS )
      sudo yum install php70w-opcache
      sudo yum install php70w-xml
      sudo yum install php70w-pdo
      sudo yum install php70w-mysqlnd
      sudo yum install php70w-gd
      sudo yum install php70w-apcu
      sudo yum install php70w-pecl-apcu
      sudo yum install php70w-mbstring
      sudo yum install php70w-imap
      
      # Restart apache
      sudo service httpd restart
  

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!


[1]:  https://symfony.com/doc/3.2/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.2/doctrine.html
[8]:  https://symfony.com/doc/3.2/templating.html
[9]:  https://symfony.com/doc/3.2/security.html
[10]: https://symfony.com/doc/3.2/email.html
[11]: https://symfony.com/doc/3.2/logging.html
[12]: https://symfony.com/doc/3.2/assetic/asset_management.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://silicondales.com/tutorials/aws-ec2-tutorials/setup-ftp-sftp-aws-ec2-instance/
[15]: https://www.youtube.com/watch?v=e9BDvg42-JI
[16]: https://stackoverflow.com/questions/19648712/amazon-aws-filezilla-transfer-permission-denied
