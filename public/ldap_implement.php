<?php
    $ds = ldap_connect("ldap://openldap", 389); //always connect securely via LDAPS when possible
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, true);

    if ($ds) {
        $authenUser = @ldap_bind($ds, "cn=admin@1111111111,cn=user,ou=edocument,dc=mode-education,dc=com", "admin@1111111111");
        $authenAdmin = @ldap_bind($ds, "cn=admin@1111111111,cn=admin,ou=edocument,dc=mode-education,dc=com", "admin@1111111111");
        
        if($authenUser||$authenAdmin) {
            echo "login successfully";
        } else {
            echo "login fail!";
        }

        $info = search_user($ds,"uid=admin@1111111111");


        @ldap_close($ds);
    }


    function search_user($ds, $uid) {
        $base_dn = "cn=admin,dc=mode-education,dc=com";
        $bind = ldap_bind($ds, $base_dn, "m0dep@ss");
        $sr = ldap_search($ds,"ou=edocument,dc=mode-education,dc=com", $uid);
        $info = ldap_get_entries($ds, $sr);
        return $info;
    }

