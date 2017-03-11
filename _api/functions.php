<?php
    /* -------------------------------------------------------------
    purpos : handling communication between parent and iframe 
    author : Benjamin
    date : Oct 17, 2016
    desc : This is only one object in this system.
    ------------------------------------------------------------- */
    require_once ('_server/libs/functions.php');
    $func = GetSafeValueGet('func',null);
    $result = null;
    switch($func) {
        case 'SetClientInfo':
            $info = array();
            $info['uid'] = GetSafeValueGet('uid',null);
            $info['name'] = GetSafeValueGet('name',null);
            //GlobalData::SetClientInfo($info);
            // for javascript
            $result = "{
                'func':'SetClientInfo',
                'params':['".$info['uid']."','".$info['name']."']
            }";
            break;
        case 'SetBusinessInfo':
            $info = array();
            $info['uid'] = GetSafeValueGet('uid',null);
            $info['name'] = GetSafeValueGet('name',null);
            //GlobalData::SetBusinessInfo($info);
            // for javascript
            $result = "{
                'func':'SetBusinessInfo',
                'params':['".$info['uid']."','".$info['name']."']
            }";
            break;
        case 'DeleteClient':
            $info = array();
            $info['uid'] = GetSafeValueGet('uid',null);
            $info['name'] = GetSafeValueGet('name',null);
            require_once ("_server/modules/Member/MemberDoc.php");
            
            $res = MemberDoc::DeleteUserByUid($info['uid']);
            // for javascript
            $result = "{
                'func':'DeleteClient',
                'params':['".$res."','".$info['uid']."','".$info['name']."']
            }";
            break;
        case 'DeleteBusiness':
            $info = array();
            $info['uid'] = GetSafeValueGet('uid',null);
            $info['name'] = GetSafeValueGet('name',null);
            require_once ("_server/modules/Member/MemberDoc.php");
            
            $res = MemberDoc::DeleteUserByUid($info['uid']);
            // for javascript
            $result = "{
                'func':'DeleteBusiness',
                'params':['".$res."','".$info['uid']."','".$info['name']."']
            }";
            break;
        case 'JoinMembership':
            $info = array();
            $info['uid'] = GetSafeValueGet('uid',null);
            $info['bid'] = GetSafeValueGet('bid',null);
            require_once ("_server/modules/Member/MemberDoc.php");
            $res = MemberDoc::JoinMembership($info['uid'],$info['bid']);
            // for javascript
            $result = "{
                'func':'AlertResult',
                'params':['".$res."','".$info['uid']."','".$info['bid']."']
            }";
            break;
    }

    //////////////////////////////////////////////////////////////////
?>
    <script type='text/javascript'>
        // Notifyer for call back 
        window.onload = function() {
            <?php 
                if(null != $result) { ?>
                    window.parent.receiveEvent(<?=$result?>);
            <?php
                } ?>
        }    
    </script>
<?php

    //if($debugMode)
    //  echo 'Load Complete!!';