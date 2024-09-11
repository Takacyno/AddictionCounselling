<?php

echo'<div id="infoMenu">
<input id="infoCheck" name="infoCheck" type="checkbox">
<label id="infoOpen" for="infoCheck">'.$patient->Allname.'</label>
<label id="infoClose" for="infoCheck"></label>
<div id=info>';
if($_SESSION["class"]==1){
    for($cnt=1;$cnt<count($patientBasicInfoName[0]);$cnt++){
        echo '<div class=oneSentence>';
        $tmpStr='<label class="info">'.$patientBasicInfoName[1][$cnt];
        if($cnt==0){
            for($cnt2=0;$cnt2<$longestPatientInfoName-1;$cnt2++){
                $tmpStr.='　';
            }
        }else{
            for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
                $tmpStr.='　';
            }
        }
        echo $tmpStr;
        echo '</label><textarea id="BasicInfo'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1" disabled=true>';
        if($cnt==2){
            if($_SESSION["rank"]==0){
                echo $hospitalNameJP[$patient->$patientBasicInfoName[0][$cnt]];
            }else{
                echo $hospitalNameJP[0];
            }
        }else if($cnt==4){
            echo $sex[$patient->$patientBasicInfoName[0][$cnt]];
        }else if($cnt==5){
            for($cnt2=0;$cnt2<count($patient->Counsellors);$cnt2++){
                echo $patient->Counsellors[$cnt2].' ';
            }
        }else if($cnt==17){
            for($cnt2=0;$cnt2<strlen($patient->TestShow);$cnt2++){
                if((int)(substr($patient->TestShow,$cnt2,1))>0){
                    echo $testNameJP[$cnt2].'　';
                }
            }
        }else if($cnt==count($patientBasicInfoName[0])-2){
            for($cnt2=0;$cnt2<$addicNum;$cnt2++){
                if((int)(substr($patient->Addictions,$cnt2,1))>0){
                    echo $addicNameJP[$cnt2].'　';
                }
            }
        }else if($cnt==count($patientBasicInfoName[0])-1){
            for($cnt2=0;$cnt2<7;$cnt2++){
                if((int)(substr($patient->Holiday,$cnt2,1))>0){
                    echo $week[$cnt2].'　';
                }
            }
        }else{
            echo $patient->$patientBasicInfoName[0][$cnt];
        }
        echo '</textarea></div>';
    }
    for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
        if($cnt==count($patientAddicInfoName[0])-3){
            continue;
        }
        echo '<div class=oneSentence>';
        $tmpStr='<label class="info" >'.$patientAddicInfoName[1][$cnt];
        for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientAddicInfoName[1][$cnt]);$cnt2++){
            $tmpStr.='　';
        }
        echo $tmpStr;
        echo '</label><textarea id="AddicInfo'.$patientAddicInfoName[0][$cnt].'" cols="50" rows="1" disabled=true>';
        echo ${'Info'.$patientAddicInfoName[0][$cnt]};
        echo '</textarea></div>';
    }
    
    echo '<label id="infoUpdateOpen" for="infoUpdateCheck">編集</label>　　';
    echo '<label id="passOpen" for="passCheck">パスワードをリセットする</label>　　';
    if($_SESSION["class"]==1){
        echo '<form  action="observe.php" method="post" class="inlineBlock" >';
        echo '<input type="submit" id="toggleStatus"  
        name="toggleStatus"
        value="送信" class="none">';
        if($patientStatus==0){
            echo '<label id="toggleStatusLabel" for="toggleStatus" >アカウントを再開する</label>　　';
        }else{
            echo '<label id="toggleStatusLabel" for="toggleStatus" >アカウントを停止する</label>　　';
        }
        echo '</form>';
    }
    echo '<label for="infoCheck" class="canPush">閉じる</label>';
    echo '</div>';
    echo '</div>';
    echo '<input id="passCheck" name="passCheck" type="checkbox">';
    echo '<label id="passClose" for="passCheck"></label>';
    echo '<form action="observe.php" method="post" id="pass">';
    echo '新しいパスワード<br><input type="password" onCopy="return false;" id="password" name="password"><br>';
    echo '再入力<br><input type="password" onCopy="return false;" id="password2"><br>';
    echo '<input type="hidden" name="passReset" value=1>';
    echo '<input type="button" onClick="passCheck(this);" value="送信">';
    echo '　　<label for="passCheck" class="canPush">閉じる</label>';
    echo '</form>';

    echo '<input id="infoUpdateCheck" name="infoUpdateCheck" type="checkbox">';
    echo'<label id="infoUpdateClose" for="infoUpdateCheck"></label>';
    echo '<div id=infoUpdate>';
    echo '<form action="observe.php" method="post" name="patientAccountForm">';
    echo '<span>名前</span>　<span class="Red">*必須</span><br>
    <input type="text" id="infoUpdateAllname" name="Allname" value="'.$patient->Allname.'"><br>
    <span>メールアドレス</span>　<span class="Red">*必須</span><br>
    <input type="email" id="infoUpdateEmail" name="Email" value="'.$Email.'"><br>
    <span>病院</span>　<span class="Red">*必須 </span><br><select id="infoUpdateHospital" name="Hospital" ';
    if($_SESSION["rank"]!=0){
        echo 'disabled=true';
    }
    echo '>';
    if($_SESSION["rank"]==0){
        for($cnt=0;$cnt<$hospitalNum;$cnt++){
            echo '<option value='.$cnt;
            if($cnt==$patient->Hospital){
                echo ' selected=true';
            }
            echo '>'.$hospitalNameJP[$cnt].'</option>';
        }
    }else{
        for($cnt=0;$cnt<$hospitalNum;$cnt++){
            echo '<option value='.$_SESSION["hospital"];
            echo '>'.$hospitalNameJP[$cnt].'</option>';
        }
    }
    echo '</select><br>
    <span>症状</span>　<span class="Red">*必須</span><br>';
        for($cnt=0;$cnt<$addicNum;$cnt++){
            echo '<input type="checkbox" id="addicCheck'.$cnt.'" name="addictions'.$cnt.'" value=1 onClick="addicCheckClick(this);" ';
            if((int)(substr($patient->Addictions,$cnt,1))>0){
                echo 'checked';
            }
            echo '><label for="addicCheck'.$cnt.'" class="inlineBlock">'.$addicNameJP[$cnt].'に関する悩み</label>　';
            if($addicStartCounselling[$cnt]==1){
                echo '<div id="addicInterruptDiv'.$cnt.'" ';
                if((int)(substr($patient->Addictions,$cnt,1))==0){
                    echo 'class="none"';
                }else{
                    echo 'class="inlineBlock"';
                }
                echo '><input type="hidden" name="addicStartCounselling'.$cnt.'" value=1><input type="checkbox" id="addicInterruptCheck'.$cnt.'" name="addicInterruptCheck'.$cnt.'" value=1 ';
                if((int)(substr($patient->Addictions,$cnt,1))==2){
                    echo 'checked';
                }
                echo '><label for="addicInterruptCheck'.$cnt.'">中止</label>';
                if((int)(substr($patient->Addictions,$cnt,1))==2){
                    echo '　再開週<select name="addicRestartWeek'.$cnt.'">';
                    for($cnt2=0;$cnt2<count($toDoDefault);$cnt2++){
                        echo '<option value='.$cnt2;
                        if($cnt2==$addicInterruptWeek[$cnt]){
                            echo ' selected=true';
                        }
                        echo '>';
                        if($cnt2==count($toDoDefault)-1){
                            echo 'after';
                        }else{
                            $tmp=$cnt2+1;
                            echo 'week'.$tmp;
                        }
                        echo '</option>';
                    }
                    echo '</select>';
                }
                echo '</div>';
            }
            echo '<br>';
        }
        $cnt=3;
        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
        // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
        //     echo '　';
        // }
        echo '</label><textarea id="infoUpdate'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1">'.$patient->$patientBasicInfoName[0][$cnt].'</textarea><br>';

        $cnt=4;
        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
        // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
        //     echo '　';
        // }
        echo '</label>';
        echo  '<select id="infoUpdate'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'">';
        for($cnt2=1;$cnt2<count($sex);$cnt2++){
            echo '<option value='.$cnt2;
            if($cnt2==(int)$patient->$patientBasicInfoName[0][$cnt]){
                echo ' selected=true';
            }
            echo '>'.$sex[$cnt2].'</option>';
        }
        echo '</select><br>';
        
        $cnt=5;
        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
        // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
        //     echo '　';
        // }
        echo '</label><div id="infoUpdateCounsellors" class="inlineBlock">';
        for($cnt2=0;$cnt2<count($patient->Counsellors);$cnt2++){
            echo '<input type="button" id="counsellor'.$patient->CounsellorIDs[$cnt2].'" class="none" onClick="deleteCounsellor(this.id)">';
            echo '<label for="counsellor'.$patient->CounsellorIDs[$cnt2].'" id="counsellor'.$patient->CounsellorIDs[$cnt2].'Label" class="canPush">'.$patient->Counsellors[$cnt2].'</label>';
            echo '<input type="text" id="counsellor'.$patient->CounsellorIDs[$cnt2].'Text" name="counsellorIDs[][counsellorIDs]" class="none" value="'.$patient->CounsellorIDs[$cnt2].'">';
        }
        echo'</div><br>';
        // for($cnt2=0;$cnt2<$longestPatientInfoName;$cnt2++){
        //     echo '　';
        // }
        // echo '<div id="plusCounsellorMenu">';
            echo '<input type="checkbox" id="plusCounsellorCheck" name="plusCounsellorCheck" >';
            echo '<label id="plusCounsellorOpen" for="plusCounsellorCheck"><img src="image/plus.png" alt="追加" width="20" height="20"></label>';
            echo '<label id="plusCounsellorClose" for="plusCounsellorCheck"></label>';
            echo '<div id="plusCounsellorDiv" class="inlineBlock">';

            echo '<div class="Block">';
            echo '<input type="text" name="searchCounsellorName" id="searchCounsellorName" >';
            echo '<input type="button" id="search" name="search" class="none" onClick="searchCounsellorNameCheck();">';
            echo '<label for="search" class="canPush"><img src="image/search.png" alt="検索" width="20" height="20"></label>';
            
            echo '</div>';

            for($cnt=0;$cnt<$hospitalNum;$cnt++){
                echo '<input type="checkbox" id="pullDown'.$cnt.'" onclick="pullDown(this.id);" class="none">';
                echo '<label for="pullDown'.$cnt.'" class="canPush">'.$hospitalNameJP[$cnt].'<img src="image/pullDown.png" alt="病院" width="20" height="12"></label><br>';
                echo '<ol id="list'.$cnt.'" class="list none">';
                for($cnt2=0;$cnt2<count($counsellors[$cnt]);$cnt2++){
                    echo '<li><input type="button" class="patientBtn" id="'.$cnt.'_'.$cnt2.'" name="'.$counsellors[$cnt][$cnt2][0].'" value="'.$counsellors[$cnt][$cnt2][1].'" onClick="addCounsellor(this.name,this.value);">';
                }
                echo '</ol>';
            }
            echo '<label for="plusCounsellorCheck" class="canPush">閉じる</label>';
            echo '</div>';
        // echo '</div><br>';
            
        for($cnt=6;$cnt<count($patientBasicInfoName[0])-3;$cnt++){
            echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
            // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
            //     echo '　';
            // }
            echo '</label><textarea id="infoUpdate'.$patientBasicInfoName[0][$cnt].'" name="'.$patientBasicInfoName[0][$cnt].'" cols="50" rows="1">'.$patient->$patientBasicInfoName[0][$cnt].'</textarea><br>';
        }
        $cnt=count($patientBasicInfoName[0])-3;
        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
            // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
            //     echo '　';
            // }
        echo '</label>';
        for($cnt=0;$cnt<count($testNameJP);$cnt++){
            echo '<input type="checkbox" id="testShowCheck'.$cnt.'" name="testShow'.$cnt.'" value="1"';
            if((int)(substr($patient->TestShow,$cnt,1))>0){
                echo 'checked';
            }
            echo '><label for="testShowCheck'.$cnt.'">'.$testNameJP[$cnt].'</label>　';
        }
        echo '<br>';
        $cnt=count($patientBasicInfoName[0])-1;
        echo '<label class="info" >'.$patientBasicInfoName[1][$cnt];
            // for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientBasicInfoName[1][$cnt]);$cnt2++){
            //     echo '　';
            // }
        echo '</label>';
        for($cnt=0;$cnt<7;$cnt++){
            echo '<input type="checkbox" id="holidayCheck'.$cnt.'" name="holiday'.$cnt.'" value="1"';
            if((int)(substr($patient->Holiday,$cnt,1))>0){
                echo 'checked';
            }
            echo '><label for="holidayCheck'.$cnt.'">'.$week[$cnt].'</label>　';
        }
        echo '<br>';

        for($cnt=0;$cnt<count($patientAddicInfoName[0]);$cnt++){
            if($cnt==count($patientAddicInfoName[0])-3){
                continue;
            }
            $tmpStr='<label class="info" >'.$patientAddicInfoName[1][$cnt];
            for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientAddicInfoName[1][$cnt]);$cnt2++){
                $tmpStr.='　';
            }
            echo $tmpStr;
            echo '</label><textarea id="infoUpdate'.$patientAddicInfoName[0][$cnt].'" name="'.$patientAddicInfoName[0][$cnt].'" cols="50" rows="1" >'.${'Info'.$patientAddicInfoName[0][$cnt]}.'</textarea>';
            if($cnt==10){
                echo '<input type="button" id="setDefaultControlStimulusInstruction" onClick="setInfoDefaultText(this)" class="none" value=0 >';
                echo '<label for="setDefaultControlStimulusInstruction" class="canPush">デフォルトに設定</label>';
            }
            if($cnt==11){
                echo '<input type="button" id="setDefaultPseudoActInstruction" onClick="setInfoDefaultText(this)" class="none" value=1>';
                echo '<label for="setDefaultPseudoActInstruction" class="canPush">デフォルトに設定</label>';
            }
            if($cnt==12){
                echo '<input type="button" id="setDefaultImaginationInstruction" onClick="setInfoDefaultText(this)" class="none" value=2>';
                echo '<label for="setDefaultImaginationInstruction" class="canPush">デフォルトに設定</label>';
            }
            echo '<br>';
        }
    echo '<input type="text" name="addPatient" value="送信" class="none">';
    echo '<input type="button" value="送信" onClick="newPatientCheck(this);">　';
    echo '<label for="infoUpdateCheck" class="canPush">閉じる</label>';
    echo '</form>';
    echo '</div>';
}else{
    $cnt=8;
    
    echo '<div class=oneSentence>';
    $tmpStr='<label class="info" >'.$patientAddicInfoName[1][$cnt];
    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientAddicInfoName[1][$cnt]);$cnt2++){
        $tmpStr.='　';
    }
    echo $tmpStr;
    echo '</label><textarea id="AddicInfo'.$patientAddicInfoName[0][$cnt].'" cols="50" rows="1" disabled=true>';
    echo ${'Info'.$patientAddicInfoName[0][$cnt]};
    echo '</textarea></div>';
    echo '<form action="observe.php" method="post">';
    echo '<input type="hidden" name="holidayForm" value=1>';
    for($cnt=0;$cnt<7;$cnt++){
        echo '<input type="checkbox" id="holidayCheck'.$cnt.'" name="holiday'.$cnt.'" value="1"';
        if((int)(substr($patient->Holiday,$cnt,1))>0){
            echo 'checked';
        }
        echo '><label for="holidayCheck'.$cnt.'">'.$week[$cnt].'</label>　';
    }
    echo '<br><input type="submit" value="送信"></form><br>';
    $cnt=9;
    echo '<div class=oneSentence>';
    $tmpStr='<label class="info" >'.$patientAddicInfoName[1][$cnt];
    for($cnt2=0;$cnt2<$longestPatientInfoName-mb_strlen($patientAddicInfoName[1][$cnt]);$cnt2++){
        $tmpStr.='　';
    }
    echo $tmpStr;
    echo '</label><textarea id="AddicInfo'.$patientAddicInfoName[0][$cnt].'" cols="50" rows="1" disabled=true>';
    echo ${'Info'.$patientAddicInfoName[0][$cnt]};
    echo '</textarea></div>';
    // echo '楽しかったこと<br>';
    // for($cnt2=0;$cnt2<count($FunEventsAll);$cnt2++){
    //     echo '<div class=oneSentence>';
    //     echo '<textarea class="overFlowAuto" cols="50" rows="12" disabled=true>'.$FunEventsAll[$cnt2].'</textarea></div>';
    // }
    echo '<label id="passOpen" for="passCheck">パスワードをリセットする</label>';
    echo '　<label for="infoCheck" class="canPush">閉じる</label><br>';
    echo '</div>';
    echo '</div>';

    echo '<input id="passCheck" name="passCheck" type="checkbox">';
    echo '<label id="passClose" for="passCheck"></label>';
    echo '<form action="observe.php" method="post" id="pass">';
    echo '新しいパスワード<br><input type="password" onCopy="return false;" id="password" name="password"><br>';
    echo '再入力<br><input type="password" onCopy="return false;" id="password2"><br>';
    echo '<input type="hidden" name="passReset" value=1>';
    echo '<input type="button" onClick="passCheck(this);" value="送信">';
    echo '　　<label for="passCheck" class="canPush">閉じる</label>';
    echo '</form>';
}

?>