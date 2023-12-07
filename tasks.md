- [x] Install a VM Operating System (production environment)
    - [x] Decide on what web server (PHP?)
        - [ ] Provision/Management page (calls Proxmox API to create/destroy VMs)
            - [ ] Install PHP Composer dependency manager
            - [ ] Install a Proxmox PHP API library https://github.com/ZzAntares/ProxmoxVE
        - [X] Install Graphana
            - [X] Set up Proxmox visualization using this template/guide: https://www.linuxsysadmins.com/monitoring-proxmox-with-grafana/?amp
            - [X] Graphana page
                - Snapshots look like the way to go for embedding an `<iframe>` https://grafana.com/blog/2023/10/10/how-to-embed-grafana-dashboards-into-web-applications/#snapshot
    - [ ] Configure Fail2Ban to block excessive/unusual activity on port 80
        - [ ] Configure Port forwarding on my network to forward requests on port 80 to the VM
    - [ ] Set up alerting (script that monitors Proxmox API and send emails)
    - [X] Install a MariaDB for holding account info
        - [x] Set up user authentication
            - [ ] Add links to the login screen to go to the register screen?
    - [ ] Set up SSH on the server
- [x] Set up some VMs for the API to control/monitor
    - [x] Kali?
    - [ ] BOINC? meh        


## Task Archive
- [x] Configure a secondary disk in Proxmox
- [x] Set up a VM (development environment)
