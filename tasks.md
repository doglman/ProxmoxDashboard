## Project Description
(in check-box and bullet-list form)
Create a web based [ ] Resource Monitoring Dashboard with:
- [ ] User authentication
- [ ] Real-time data visualization
- [ ] Alerting capabilities
to monitor computer resources. This dashboard will offer a comprehensive overview of:
- [ ] Data center infrastructure
- [ ] VM Status
- [ ] Performance metrics
Users will be able to:
- [ ] Manage resources efficiently
- [ ] Provision and de-provision VMs
- [ ] Receive notifications for critical events

## Tasks
- [x] Install a VM Operating System (production environment)
    - [x] Decide on what web server (PHP?)
        - [ ] Provision/Management page (calls Proxmox API to create/destroy VMs)
            - [x] Install PHP Composer dependency manager
            - [x] Install a Proxmox PHP API library https://github.com/ZzAntares/ProxmoxVE
            - [ ] Code a PHP page that gives an interface to:
                - [x] List VMs that have already been made
                    - [x] With "delete" buttons to deprovision
                    - [x] With "start" and "stop" buttons
                - [x] List VMs that are available to be made (perhaps with a form to specify amount of RAM, etc) with a "create" button
                - [ ] Make it look better with Boostrap components
                - [ ] Add a URL to the remote console for each VM
        - [X] Install Graphana
            - [X] Set up Proxmox visualization using this template/guide: https://www.linuxsysadmins.com/monitoring-proxmox-with-grafana/?amp
            - [X] Graphana page
                - Snapshots look like the way to go for embedding an `<iframe>` https://grafana.com/blog/2023/10/10/how-to-embed-grafana-dashboards-into-web-applications/#snapshot
    - [ ] Configure Fail2Ban to block excessive/unusual activity on port 80. (IT210 Lab 5b)
    - [ ] Set up alerting (script that monitors Proxmox API and send emails)
    - [X] Install a MariaDB for holding account info
        - [x] Set up user authentication
            - [ ] Add links to the login screen to go to the register screen?
            - [ ] Adjust PHP so it doesn't show the content unless someone sets a "authorized" flag in the DB?
    - [ ] Set up SSH on the server with public key only encryption
- [ ] Set up a domain from No-IP (who we used for IT210)
- [ ] Set up port-forwarding on Sams router for the necessary ports to forward to the VM
- [x] Set up some VMs for the API to control/monitor
    - [x] Kali?
    - [ ] BOINC? meh
- [ ] Create an `.env.example` file for documentation purposes


## Task Archive
- [x] Configure a secondary disk in Proxmox
- [x] Set up a VM (development environment)
