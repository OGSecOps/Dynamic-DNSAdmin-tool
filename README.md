# Dynamic-DNSAdmin-tool

I decided to created this open project in order to compile, code and instructions necessary to implement dynamic DNS updates by using a front-end web application based on Php and ultimately try to create a centralise tool for DNS management.

## Introduction 

DNS is an abbreviation for Domain Name System. The purpose of DNS is to translate IP addresses  into human-readable names (and vice versa) to identified devices and servers on the Internet. Nowadays the must reliable and popular implementation of DNS servers is BIND 9.9. DNSAdmin is a open project that looks to create a simple and convenient tool to provide support for dynamic DNS updates and the capability to propagated this updates as soon as a change is made, all this based on a DNS-BIND server implementation. The main idea behind DNSAdmin client is  you to perform nsupdates on the target DNS server by passing parameters through HTTP requests.

## Setting Environment / Requirements

For now, the network used to implement the DNS record scope must be located manually Ex. 0.0.0.0/24, improvements to this section are very welcome. 

DNSAdmin rely its functionality mainly in a DNS server properly configured with support for Dynamic Zone Updates by implementing encrypted TGI key for security, DNSAdmin has its own zone to allocated the service at http://dnsadmin.dyn1. Since the tool is based on a web system, it is necessary the used of several applications to set up this environment. 

First application need it is a http server, in this case the web service recommended is Apache24, that should be configured to support multiple virtual host allocated in the server, there should be one virtual host record that holds the path to the dnsadmin.dyn website. 

Second, because the tool is written on Php programming language the installation of this software is necessary on the server, support of Php on apache24 must be configure if need it. 

Finally MySQL server must be installed in the rule host to provided the necessary support for the DNSAdmin database. In addition it is important to know that DNSAdmin make use of the tool nsupdate to send queries to the BIND DNS server in order to perform the dynamic updates of the zone records.

##IMPORTANT:

The file functions.php is where you can change Data Base connection settings, Ip scope for arpa resolution and nsupdate directory.

##Intended functionality

As we said before DNSAdmin is a tool oriented to provide means for created new entries in the DNS zones without the need of restart the service. some of the key features of the tool are.
 
* Multiuser support, by making use of php session to login into the system.
* session start() protection for each web page of the system.
* Easily View the zones that you are currently monitoring.
* Easly Add, Remove or Edit records allocated in your zones.
* Change have immediately effect in your DNS server.
* Easily manage your account details.
* Useful links to view DNS configuration files for Admin only.
* Incomplete modules are:  Master Zone and User creation, Assignation of zone to users.

Levels of functionality vary on the type of user.

##DNSAdmin database

DNSAdmin make use of a MySQL database to keep record of each user, each zone, and each host record entered through the web interface. This database contains tables that will create a reliable relationship between the users registered in the system an the zones already allocated for then. Users then can manage their zones records dynamically without the need to restart the actual BIND service.

##Multiuser Implementation

DNSAdmin provide users means to dynamically make changes in the DNS database by exploiting the Dynamic DNS functionality. This functionality is implemented with Php scripts to provide a back-end solution. After the successful deployment of Dynamic DNS entry for the domain, the system have the ability to update entries with a simple web request. The front-end web interface collect the necessary data to add, deleted or modify any entry on the DNS zone database, and the back-end system successful acknowledge this data to create journal BIND files according to the entered data. The back-end scripts will “run underground” the nsupdate BIND DDNS command to dynamically update the DNS database.
  
The integrity of the user database is respected, by not allowing access to edit DNS zones for domains of others user. Admin user will be able manage all of their customer's records under one account. There are two groups of user supported by the system, Administrators and low level users. Admin user basically are by default in "god" mode, so they can see and manage every single zone, record and config files for the DNS server. Low level users are designated only to manage host records under the zones allocated for them, this user do not have access to the admin links for view config files. It is important to know that valid login users need to be emails addresses to create a level of responsibility for the user.
