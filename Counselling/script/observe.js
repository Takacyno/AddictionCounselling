function addicCheckClick(obj){
    var num=obj.id.substr(10);
    if(addicStartCounselling[num]==1){
        if(obj.checked){
            if(document.getElementById("addicInterruptDiv"+num).classList.contains("none")){
                document.getElementById("addicInterruptDiv"+num).classList.remove("none");
            }
            if(!document.getElementById("addicInterruptDiv"+num).classList.contains("inlineBlock")){
                document.getElementById("addicInterruptDiv"+num).classList.add("inlineBlock");
            }
        }else{
            if(document.getElementById("addicInterruptDiv"+num).classList.contains("inlineBlock")){
                document.getElementById("addicInterruptDiv"+num).classList.remove("inlineBlock");
            }
            if(!document.getElementById("addicInterruptDiv"+num).classList.contains("none")){
                document.getElementById("addicInterruptDiv"+num).classList.add("none");
            }
            document.getElementById("addicInterruptCheck"+num).checked=false;
        }
    }
}
function newPatientCheck(obj){
    obj.disabled=true;
    var ok=1;
    if(document.getElementById("infoUpdateAllname").value==''){
        myAlert('名前を入力してください');
        ok=0;
    }
    if(ok==1){
        if(document.getElementById("infoUpdateEmail").value==''){
            myAlert('メールアドレスを入力してください');
            ok=0;
        }
    }
    if(ok==1){
        if(!document.getElementById("infoUpdateEmail").value.match(/[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/)){
            myAlert('メールアドレスを確認してください');
            ok=0;
        }
    }
    if(ok==1){
        var email=document.getElementById("infoUpdateEmail").value;
        for(var j=0;j<Emails.length;j++){
            if(email==Emails[j]){
                myAlert('メールアドレスを確認してください');
                ok=0;
                break;
            }
        }
    }
    if(ok==1){
        var selected=0;
        for(var j=0;j<addicNum;j++){
            if(document.getElementById("addicCheck"+j).checked){
                selected=1;
                break;
            }
        }
        if(selected==0){
            myAlert('少なくとも1つ症状を選択してください');
            ok=0;
        }
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}

function addicPlus_click(id){
    document.getElementById("plusNumSelect"+id.substr(9)).classList.toggle("none");
    document.getElementById("plusUnitSelect"+id.substr(9)).classList.toggle("none");
}
function addicPlusUpdate_click(id){
    document.getElementById("plusUpdateNumSelect"+id.substr(15)).classList.toggle("none");
    document.getElementById("plusUpdateUnitSelect"+id.substr(15)).classList.toggle("none");
}
function toDoDefault_click(){
    var selectedDefault=Number(document.getElementById("toDoDefaultSelect").value);
    if(selectedDefault>0){
        for(var i=0;i<toDoNum;i++){
            document.getElementById(toDoName[i]+"Select").options[Number(toDoDefault[selectedDefault-1][Number(i)])].selected=true;
        }
    }
}
function toDoDate_check(obj){
    
    var selectedDate=new Date(document.getElementById("toDoY").value,document.getElementById("toDoM").value-1,document.getElementById("toDoD").value,0,0,0);
    
    var ok=1;
    if(document.getElementById("toDoM").value!=selectedDate.getMonth()+1){
        myAlert('実際にある日付を入力してください');
        ok=0;
    }
    if(ok==1){
        var today=new Date(todayText);
        today.setDate(today.getDate()-1);
        if(selectedDate.getTime()<today.getTime()){
            myAlert('今日以降の日付を入力してください');
            ok=0;
        }
    }
    if(ok==1){
        switch(Number(document.getElementById("toDoDateChange").value)){
            case 1:
                var checkDate=new Date(startProcessDate[7]);
                checkDate.setDate(checkDate.getDate()-1);
                if(selectedDate.getTime()<checkDate.getTime()){
                    myAlert('想像の開始日以降の日付を入力してください');
                    ok=0;
                }
                break;
            case 4:
                break;
            case 6:
                var checkDate=new Date(startProcessDate[4]);
                checkDate.setDate(checkDate.getDate()-1);
                if(selectedDate.getTime()<checkDate.getTime()){
                    myAlert('制御刺激の開始日以降の日付を入力してください');
                    console.log(selectedDate.getDate());
                    console.log(checkDate.getDate());
                    ok=0;
                }
                break;
            case 7:
                var checkDate=new Date(startProcessDate[6]);
                checkDate.setDate(checkDate.getDate()-1);
                if(selectedDate.getTime()<checkDate.getTime()){
                    myAlert('疑似行為の開始日以降の日付を入力してください');
                    ok=0;
                }
                break;
            default:
                ok==0;
                break;
        }
    }
    if(ok==1){
        obj.form.submit();
    }   
}

function check_time(obj){
    obj.disabled=true;
    var anyCheck=0,error=0;
    var startDate=new Date(mdY[0],mdY[1]-1,mdY[2],document.getElementById("startHourSelect").value,document.getElementById("startMinuteSelect").value*10,0);
    var endDate=new Date(mdY[0],mdY[1]-1,mdY[2],Number(document.getElementById("endHourSelect").value),document.getElementById("endMinuteSelect").value*10,0);

    for(var i=0;i<3;i++){
        if(document.getElementById(calName[i]+"Plus").value==''){
            myAlert(calNameJP[i]+'を入力してください');
            error=1;
            break;
        }
    }
    if(error==0){
        for(var i=0;i<addicCalNum+1;i++){
            if(i==addicCalNum){
                if(document.getElementById('OtherPlus').value!=''){
                    anyCheck=1;
                    break;
                }
            }else{
                if(document.getElementById('plusCheck'+i).checked==true){
                    anyCheck=1;
                    break;
                }
            }
        }
        if(anyCheck==0){
            myAlert(calmyAlertNameJP[nowAddic]+'を入力してください');
            error=1;
        }
    }
    if(error==0){
        if(startDate.getTime()>=endDate.getTime()){
            myAlert('終了時刻を開始時刻よりおそくしてください');
            error=1;
        }
    }
    if(error==0){
        for(var i=0;i<todayTimes.length;i++){
            var tmpSDate=new Date(todayTimes[i][0]);
            var tmpEDate=new Date(todayTimes[i][1]);
            if(!((tmpSDate.getTime()<=startDate.getTime()&&tmpEDate.getTime()<=startDate.getTime())||(tmpSDate.getTime()>=endDate.getTime()&&tmpEDate.getTime()>=endDate.getTime()))){
                myAlert('スケジュールが重なっています');
                error=1;
                break;
            }
        }
    }
    if(error==0){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function passCheck(obj){
    obj.disabled=true;
    var ok=1;
    var pass=document.getElementById("password").value;
    if(pass!=document.getElementById("password2").value){
        myAlert('パスワードが一致しません');
        ok=0;
    }
    if(ok==1){
        if(pass.length<6){
            myAlert('６文字以上にしてください');
            ok=0;
        }    
    }
    if(ok==1){
        if(pass.length>50){
            myAlert('５０文字以下にしてください');
            ok=0;
        }    
    }
    if(ok==1){
        if(!pass.match(/^[a-zA-Z0-9]+$/)){
            myAlert('英数字で入力してください');
            ok=0;
        }    
    }
    if(ok==1){
        if(pass.match(/^[0-9a-z]+$/)||pass.match(/^[0-9A-Z]+$/)||pass.match(/^[a-zA-Z]+$/)){
            myAlert('アルファベットの大文字小文字と数字を含めてください');
            ok=0;
        }    
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function setInfoDefaultText(obj){
    document.getElementById('infoUpdate'+obj.id.substr(10)).textContent=defaultText[obj.value];
}
function startProcessDate_check(obj){
    obj.disabled=true;
    var num=obj.id.substr(16);
    var selectedDate=new Date(document.getElementById("startProcessY"+num).value,document.getElementById("startProcessM"+num).value-1,document.getElementById("startProcessD"+num).value,0,0,0);
    if(document.getElementById("startProcessM"+num).value==selectedDate.getMonth()+1){
        var today=new Date(todayText);
        today.setDate(today.getDate()-1);
        if(selectedDate.getTime()<today.getTime()){
            myAlert('今日以降の日付を入力してください');
            obj.disabled=null;
        }else{
            obj.form.submit();
        }
    }else{
        myAlert('実際にある日付を入力してください');
        obj.disabled=null;
    }
}

function check_updateTime(obj){
    obj.disabled=true;
    var anyCheck=0,error=0;
    var startDate=new Date(mdY[0],mdY[1]-1,mdY[2],document.getElementById("startHourUpdateSelect").value,document.getElementById("startMinuteUpdateSelect").value*10,0);
    var endDate=new Date(mdY[0],mdY[1]-1,mdY[2],Number(document.getElementById("endHourUpdateSelect").value),document.getElementById("endMinuteUpdateSelect").value*10,0);

    for(var i=0;i<3;i++){
        if(document.getElementById(calName[i]+"PlusUpdate").value==''){
            myAlert(calNameJP[i]+'を入力してください');
            error=1;
            break;
        }
    }
    if(error==0){
        for(var i=0;i<addicCalNum+1;i++){
            if(i==addicCalNum){
                if(document.getElementById('OtherPlusUpdate').value!=''){
                    anyCheck=1;
                    break;
                }
            }else{
                if(document.getElementById('plusUpdateCheck'+i).checked==true){
                    anyCheck=1;
                    break;
                }
            }
        }
        if(anyCheck==0){
            myAlert(calmyAlertNameJP[nowAddic]+'を入力してください');
            error=1;
        }
    }
    if(error==0){
        if(startDate.getTime()>=endDate.getTime()){
            myAlert('終了時刻を開始時刻よりおそくしてください');
            error=1;
        }
    }
    if(error==0){
        for(var i=0;i<todayTimes.length;i++){
            if(i!=Number(document.getElementById('plusUpdateOk').value)-1){
                var tmpSDate=new Date(todayTimes[i][0]);
                var tmpEDate=new Date(todayTimes[i][1]);
                if(!((tmpSDate.getTime()<=startDate.getTime()&&tmpEDate.getTime()<=startDate.getTime())||(tmpSDate.getTime()>=endDate.getTime()&&tmpEDate.getTime()>=endDate.getTime()))){
                    myAlert('スケジュールが重なっています');
                    error=1;
                    break;
                }
            }
        }
    }
    if(error==0){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function schedule_click(value){
    var startDate=new Date(todayTimes[value][0]);
    var endDate=new Date(todayTimes[value][1]);
    document.getElementById('plusUpdateOk').value=value+1;
    document.getElementById('startHourUpdateSelect').options[startDate.getHours()].selected=true;
    document.getElementById('startMinuteUpdateSelect').options[startDate.getMinutes()/10].selected=true;
    if(startDate.getDate()==endDate.getDate()){
        document.getElementById('endHourUpdateSelect').options[endDate.getHours()].selected=true;
    }else{
        document.getElementById('endHourUpdateSelect').options[endDate.getHours()+24].selected=true;
    }
    document.getElementById('endMinuteUpdateSelect').options[endDate.getMinutes()/10].selected=true;
    for(var i=0;i<calName.length;i++){
        document.getElementById(calName[i]+'PlusUpdate').textContent=todayContents[value][i+3];
    }
    for(var i=0;i<addicCalNum;i++){
        if(!document.getElementById("plusUpdateNumSelect"+i).classList.contains("none")){
            document.getElementById("plusUpdateNumSelect"+i).classList.toggle("none");
            document.getElementById("plusUpdateUnitSelect"+i).classList.toggle("none");
            document.getElementById('plusUpdateCheck'+i).checked=false;
        }
        
        if(todayContents[value][6+i*3]==1){
            document.getElementById('plusUpdateCheck'+i).click();
            document.getElementById('plusUpdateCheck'+i).checked=true;
        }
        document.getElementById('plusUpdateNumSelect'+i).options[todayContents[value][6+i*3+1]].selected=true;
        document.getElementById('plusUpdateUnitSelect'+i).options[todayContents[value][6+i*3+2]].selected=true;
    }
    document.getElementById('OtherPlusUpdate').textContent=todayContents[value][6+addicCalNum*3];
    document.getElementById('plusUpdateCheck').checked=true;
}
function aboutWhatClick(num){
    document.getElementById('aboutWhatText').textContent=ImaginationText[num][4];
    document.getElementById('aboutWhatSelect').options[Number(num)].selected=true;
}
function aboutWhatSelectChange(num){
    document.getElementById('aboutWhatText').textContent=ImaginationText[num][4];
}
function ObservationSelect_change(value){
    var cnt=Number(Number(value)-1);
    var tmp=Number(Number(daySum)+Number(value));
    var tmpString='累計'+tmp+'回目';
    if(nowToDoView==6){
        if(tmp%10==0){
            tmpString+=ObservationNameJP[26][1];
        }else{
            tmpString+=ObservationNameJP[26][0];
        }
        document.getElementById('Re'+toDoName[nowToDoView-2]+'TimeZoneSelect').options[Observation[cnt][28]].selected=true; 
    }
    document.getElementById('ReObservationHowmany').value=tmpString;
    if(nowToDoView==7){
        document.getElementById('ReaboutWhatSelect').options[Observation[cnt][22]].selected=true;
        document.getElementById('ReaboutWhatText').textContent=ImaginationText[Observation[cnt][28]][4];
        for(cnt2=0;cnt2<20;cnt2++){
            document.getElementById('Re'+toDoName[nowToDoView-2]+'word'+cnt2).value=Observation[cnt][29+cnt2];
        }
    }
    for(var cnt2=0;cnt2<2;cnt2++){
        var textCount=0;
        for(var cnt3=0;cnt3<5;cnt3++){
            if(cnt3==3){
                document.getElementById('Re'+ObservationName[1][cnt3]+ObservationName[0][cnt2]+'Select').options[Observation[cnt][3+textCount+cnt2*9]].selected=true;
                textCount++;
            }else{
                for(cnt4=0;cnt4<ObservationNameJP[2+cnt3*2].length;cnt4++){
                    if(Observation[cnt][3+textCount+cnt2*9].substr(cnt4,1)==1){
                        document.getElementById('Re'+ObservationName[1][cnt3]+ObservationName[0][cnt2]+'Check'+cnt4).checked=true;    
                    }else{
                        document.getElementById('Re'+ObservationName[1][cnt3]+ObservationName[0][cnt2]+'Check'+cnt4).checked=false;
                    }
                }
                document.getElementById('Re'+ObservationName[1][cnt3]+'Text'+ObservationName[0][cnt2]).value=Observation[cnt][4+textCount+cnt2*9];
                RetextDisplaySwitch('Re'+ObservationName[1][cnt3]+ObservationName[0][cnt2]+'Check'+textCheck[cnt3]);
                textCount+=2;
            }
        }
        // document.getElementById('Re'+'OtherText'+cnt2).value=Observation[cnt][8+cnt2*6];
        // RetextDisplaySwitch('Re'+ObservationName[1][cnt3-1]+ObservationName[0][cnt2]+'Check'+2);
        // if(document.getElementById('Re'+ObservationName[1][cnt3]+ObservationName[0][cnt2]+'Check'+cnt4).checked==true)
        // RetextDisplaySwitch('Re'+ObservationName[1][4]+ObservationName[0][cnt2]+'Check'+textDisplay[0]);
    }
    document.getElementById('Re'+toDoName[nowToDoView-2]+ObservationName[2][0]+'Select').options[Observation[cnt][21]].selected=true;
    RetextDisplaySwitch('Re'+toDoName[nowToDoView-2]+ObservationName[2][0]+'Select');
    for(var cnt2=0;cnt2<3;cnt2++){
        document.getElementById('Re'+ObservationName[2][1+cnt2*2]+'Select').options[Observation[cnt][22+cnt2*2]].selected=true;
        document.getElementById('Re'+toDoName[nowToDoView-2]+ObservationName[2][2+cnt2*2]).value=Observation[cnt][23+cnt2*2];
        RetextDisplaySwitch('Re'+ObservationName[2][1+cnt2*2]+'Select');
    }
}
function textDisplaySwitch(id){
    var idString=String(id);
    // if(idString.includes(ObservationName[0][0])){
    //     document.getElementById(ObservationName[1][5]+ObservationName[0][0]+'Div').classList.toggle("none");
    // }else if(idString.includes(ObservationName[0][1])){
    //     document.getElementById(ObservationName[1][5]+ObservationName[0][1]+'Div').classList.toggle("none");
    // }
    if(idString.includes(ObservationName[0][0])||idString.includes(ObservationName[0][1])){
        var divName =id.replace("Before", "TextBefore").replace("After", "TextAfter").replace(/Check/g, '').replace(/\d+/g, '')+'Div';
        if(document.getElementById(id).checked&&document.getElementById(divName).classList.contains("none")){

            while(1){
                document.getElementById(divName).classList.remove("none");
                if(!document.getElementById(divName).classList.contains("none"))break;
            }
        }
        if(!document.getElementById(id).checked&&!document.getElementById(divName).classList.contains("none")){
            document.getElementById(divName).classList.toggle("none");
        }
    }
    else if(idString.includes(ObservationName[2][0])){
        if(document.getElementById(id).value>=1){
            if(document.getElementById(ObservationName[2][1]+'Div').classList.contains("none")){
                document.getElementById(ObservationName[2][1]+'Div').classList.remove("none");
            }
        }else{
            if(!document.getElementById(ObservationName[2][1]+'Div').classList.contains("none")){
                document.getElementById(ObservationName[2][1]+'Div').classList.add("none");
            }
        }
    }else{
        for(var i=0;i<3;i++){
            if(idString.slice(0,-6)==ObservationName[2][1+i*2]){
                if(document.getElementById(id).value==textDisplay[1+i]){
                    if(document.getElementById(idString.slice(0,-6)+'TextDiv').classList.contains("none")){
                        document.getElementById(idString.slice(0,-6)+'TextDiv').classList.remove("none");
                    }
                }else{
                    if(!document.getElementById(idString.slice(0,-6)+'TextDiv').classList.contains("none")){
                        document.getElementById(idString.slice(0,-6)+'TextDiv').classList.add("none");
                    }
                }
                break;
            }
        }
    }
}

function ReaboutWhatClick(num){
    document.getElementById('ReaboutWhatText').textContent=ImaginationText[num][4];
    document.getElementById('ReaboutWhatSelect').options[Number(num)].selected=true;
}
function ReaboutWhatSelectChange(num){
    document.getElementById('ReaboutWhatText').textContent=ImaginationText[num][4];
}

function RetextDisplaySwitch(id){
    var idString=String(id);
    if(idString.includes(ObservationName[0][0])||idString.includes(ObservationName[0][1])){
        var divName =id.replace("Before", "TextBefore").replace("After", "TextAfter").replace(/Check/g, '').replace(/\d+/g, '')+'Div';
        if(document.getElementById(id).checked&&document.getElementById(divName).classList.contains("none")){

            while(1){
                document.getElementById(divName).classList.remove("none");
                if(!document.getElementById(divName).classList.contains("none"))break;
            }
        }
        if(!document.getElementById(id).checked&&!document.getElementById(divName).classList.contains("none")){
            document.getElementById(divName).classList.toggle("none");
        }
    }else if(idString.includes(ObservationName[2][0])){
        
        if(document.getElementById(id).value>=1){
            if(document.getElementById('Re'+ObservationName[2][1]+'Div').classList.contains("none")){
                while(1){
                    document.getElementById('Re'+ObservationName[2][1]+'Div').classList.remove("none");
                    if(!document.getElementById('Re'+ObservationName[2][1]+'Div').classList.contains("none"))break;
                }
                
            }
        }else{
            if(!document.getElementById('Re'+ObservationName[2][1]+'Div').classList.contains("none")){
                document.getElementById('Re'+ObservationName[2][1]+'Div').classList.toggle("none");
            }
        }
    }else{
        for(var i=0;i<3;i++){
            if(idString.slice(0,-6)=='Re'+ObservationName[2][1+i*2]){
                if(document.getElementById(id).value==textDisplay[1+i]){
                    if(document.getElementById(idString.slice(0,-6)+'TextDiv').classList.contains("none")){
                        while(1){
                            document.getElementById(idString.slice(0,-6)+'TextDiv').classList.remove("none");
                            if(!document.getElementById(idString.slice(0,-6)+'TextDiv').classList.contains("none"))break;
                        }
                        
                    }
                }else{
                    if(!document.getElementById(idString.slice(0,-6)+'TextDiv').classList.contains("none")){
                        document.getElementById(idString.slice(0,-6)+'TextDiv').classList.add("none");
                    }
                }
                break;
            }
        }
    }
}


function newCounsellorCheck(obj){
    
    var ok=1;
    if(ok==1){
        if(document.getElementById("counsellorRank").value==0){
            myAlert('役職を選択してください');
            ok=0;
        }
    }

    if(ok==1){
        if(document.getElementById("counsellorAllname").value==''){
            myAlert('名前を入力してください');
            ok=0;
        }
    }
    if(ok==1){
        if(!document.getElementById("counsellorEmail").value.match(/[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/)){
            myAlert('メールアドレスを確認してください');
            ok=0;
        }
    }
    if(ok==1){
        var email=document.getElementById("counsellorEmail").value;
        for(var j=0;j<Emails.length;j++){
            if(email==Emails[j]){
                myAlert('メールアドレスを確認してください');
                ok=0;
                break;
            }
        }
    }
    if(ok==1){
        if(document.getElementById("counsellorHospital").value==0){
            myAlert('病院を選択してください');
            ok=0;
        }
    }

    if(ok==1){
        obj.form.submit();
    }
}
function pullDown(id){
    if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
        while(1){
            if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
                document.getElementById('list'+id.substr(8)).classList.remove("none");
            }else{
                break;
            }
        }
        for(var k=0;k<counsellors[id.substr(8)].length;k++){
            if(document.getElementById(id.substr(8)+'_'+k).classList.contains("none")){
                document.getElementById(id.substr(8)+'_'+k).classList.remove("none");
            }
        }
    }else{
        document.getElementById('list'+id.substr(8)).classList.add("none");
    }
}
function searchCounsellorNameCheck(){
    var searchName=document.getElementById("searchCounsellorName").value;
    var found=0;
    for(var j=0;j<counsellors.length;j++){
        while(1){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }else{
                break;
            }
        }
        for(var k=0;k<counsellors[j].length;k++){
            if(toHankaku(counsellors[j][k][1]).indexOf(searchName)>=0){
                found=1;
                while(1){
                    if(document.getElementById(j+'_'+k).classList.contains("none")){
                        document.getElementById(j+'_'+k).classList.remove("none");
                    }else{
                        break;
                    }
                }
            }else{
                if(!document.getElementById(j+'_'+k).classList.contains("none")){
                    document.getElementById(j+'_'+k).classList.add("none");
                }
            }
        }
    }

    if(found==0){
        myAlert('見つかりませんでした');
    }
}
function toHankaku(str){
    return (str.replace(/[！-～]/g,function(s){
        return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
    })).toLowerCase();
}
function addCounsellor(name,value){
    var newButton = document.createElement('input'); 
    newButton.setAttribute("type","button");
    newButton.setAttribute("id","counsellor"+name);
    newButton.classList.add("none");
    var newLabel=document.createElement('label'); 
    newLabel.setAttribute("id","counsellor"+name+"Label");
    newLabel.setAttribute("for","counsellor"+name);
    newLabel.classList.add("canPush");
    newLabel.appendChild(document.createTextNode(value));
    var newText=document.createElement('input'); 
    newText.setAttribute("type","text");
    newText.setAttribute("id","counsellor"+name+"Text");
    newText.setAttribute("name","counsellorIDs[][counsellorIDs]");
    newText.appendChild(document.createTextNode(name));
    newText.setAttribute("value",name);
    newText.classList.add("none");
    newButton.onclick=function(){
        deleteCounsellor(newButton.id);
    };
    document.getElementById("infoUpdateCounsellors").appendChild(newButton);
    document.getElementById("infoUpdateCounsellors").appendChild(newLabel);
    document.getElementById("infoUpdateCounsellors").appendChild(newText);
}
function deleteCounsellor(id){
    document.getElementById('okORcancel').value=id;
    myConfirm("取り消しますか");
}
function showFunEventsAbstract(){
    document.getElementById("showFunEventsAbstractLabel").classList.add("none");
    document.getElementById("plusOneFunEventsAbstractDiv").classList.remove("none");
}
function showFunEventsConcrete(){
    document.getElementById("showFunEventsConcreteLabel").classList.add("none");
    document.getElementById("FunEventsConcreteDiv").classList.remove("none");
}
function FunEventsConcreteButtonClick(num){
    document.getElementById('selecedFunEventsConcrete').value=incompleteFunEventsConcrete[num][1];
    document.getElementById('FunEventsConcreteAbstract').textContent=incompleteFunEventsConcrete[num][5];
    document.getElementById('FunEventsConcrete').textContent=incompleteFunEventsConcrete[num][7];
    document.getElementById('FunEventsConcreteSelect').options[Number(num)].selected=true;
}
function FunEventsConcreteSelectChange(number){
    document.getElementById('selecedFunEventsConcrete').value=incompleteFunEventsConcrete[number][1];
    document.getElementById('FunEventsConcreteAbstract').textContent=incompleteFunEventsConcrete[number][5];
    document.getElementById('FunEventsConcrete').textContent=incompleteFunEventsConcrete[number][7];
}

function FunEventsReadButtonClick(num){
    document.getElementById('FunEventsReadAbstract').textContent=FunEvents[num][0];
    document.getElementById('FunEventsReadConcrete').textContent=FunEvents[num][1];
    document.getElementById('FunEventsReadSelect').options[Number(num)].selected=true;
}

function FunEventsReadSelectChange(num){
    document.getElementById('FunEventsReadAbstract').textContent=FunEvents[num][0];
    document.getElementById('FunEventsReadConcrete').textContent=FunEvents[num][1];
}

function plusImaginationTextDate_check(obj){
    obj.disabled=true;
    var num=obj.id.substr(16);
    var selectedDate=new Date(document.getElementById("plusImaginationTextY"+num).value,document.getElementById("plusImaginationTextM"+num).value-1,document.getElementById("plusImaginationTextD"+num).value,0,0,0);
    if(document.getElementById("plusImaginationTextM"+num).value==selectedDate.getMonth()+1){
        document.getElementById("ImaginationTextNum").value=num;
        document.getElementById("ImaginationTextComplete").value=obj.id.substr(0,1);
        obj.form.submit();
    }else{
        myAlert('実際にある日付を入力してください');
        obj.disabled=null;
    }
}
document.addEventListener("DOMContentLoaded", function() {
if(nowCalView==1&&nowToDoView==10){
    $(function() {
        $('#BBS').animate({scrollTop:$('#BBSbottom').offset().top }, 0, 'swing');
    });
}
});
$(function() {
    $('.noDobble').on('click', function(){
        $(this).prop("disabled",true);
        $("#"+$(this).attr("id")+"Form").submit();
    });
});
const myAlert = ((  ) =>{

    let alt=null,p=null,btn=null;

    window.addEventListener( "DOMContentLoaded" , ()=> {
        if( alt !== null ) return;

        alt = document.getElementById("alert");
        p = alt.querySelector("p");
        btn = alt.querySelector("button");
        btn.addEventListener("click",()=>alt.style.display="none");

    });

    return ( text )=>{
        p.textContent = text;
        alt.style.display="block";
    }

})();
function ok_click(){
    var alt = document.getElementById("confirm");
    if(!alt.classList.contains("none")){
        alt.classList.add("none");    
    }
    id=document.getElementById("okORcancel").value;
    document.getElementById(id).remove();
    document.getElementById(id+"Label").remove();
    document.getElementById(id+"Text").remove();
}
function cancel_click(){
    var alt = document.getElementById("confirm");
    if(!alt.classList.contains("none")){
        alt.classList.add("none");    
    }
}
function myConfirm(text){
    var alt=null,p=null;
    alt = document.getElementById("confirm");
    p = alt.querySelector("p");
    p.textContent = text;
    if(alt.classList.contains("none")){
        alt.classList.remove("none");    
    }
}
function updateBBSClick(obj){
    obj.disabled=true;
    document.getElementById("BBSUpdate").value=1;
    obj.form.submit();
}
function deleteBBSClick(obj){
    obj.disabled=true;
    document.getElementById("BBSUpdate").value=2;
    obj.form.submit();
}
function FrontCoverBBSClick(id){
    if(document.getElementById('updateThisFrontCoverBBSForm').classList.contains("none")){
        document.getElementById('updateThisFrontCoverBBSForm').classList.remove("none");
    }
    var num=Number(id.substr(13));
    document.getElementById('FrontCoverBBSNum').value=frontCoverBBS[num][0];
    document.getElementById('FrontCoverBBSBBSstatus').options[frontCoverBBS[num][1]].selected=true;
    document.getElementById('FrontCoverBBSTextContents').value=frontCoverBBS[num][5];
}
function updateThisFrontCoverBBSClick(obj){
    obj.disabled=true;
    var ok=1;
    if(document.getElementById('FrontCoverBBSBBSstatus').value==1){
        if(document.getElementById('FrontCoverBBSTextContents').value==""){
            myAlert('テキストを入力してください');
            ok=0;
        }
    }
    
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function plusFrontCoverBBSClick(obj){
    obj.disabled=true;
    var ok=1;
    if(document.getElementById('plusFrontCoverBBSTextContents').value==""){
        myAlert('テキストを入力してください');
        ok=0;
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function submitClick(obj){
    obj.disabled=true;
    obj.form.submit();
}
function EssayCompleteClick(obj){
    obj.disabled=true;
    document.getElementById("EssaySaveComplete").value=1;
    obj.form.submit();
}
function FunEventsAbstractSaveCompleteClick(obj){
    obj.disabled=true;
    var num=obj.id.split('__');
    if(document.getElementById('FunEventsAbstractInput'+num[1]).value==""){
        myAlert('テキストを入力してください');
        obj.disabled=null;
    }else{
        document.getElementById("FunEventsAbstractSaveComplete").value=num[0];
        document.getElementById("FunEventsAbstractSaveCompleteNum").value=num[1];
        obj.form.submit();
    }
}
function FunEventsCompleteSaveCompleteClick(obj){
    obj.disabled=true;
    if(document.getElementById('FunEventsConcrete').value==""){
        myAlert('テキストを入力してください');
        obj.disabled=null;
    }else{
        if(obj.id=="FunEventsConcreteSave"){
            document.getElementById("FunEventsConcreteSaveComplete").value=1;
        }else{
            document.getElementById("FunEventsConcreteSaveComplete").value=2;
        }

        obj.form.submit();
    }
}
function FunEventsReadTextSubmitClick(obj){
    obj.disabled=true;
    if(document.getElementById('FunEventsReadAbstract').value==""||document.getElementById('FunEventsReadConcrete').value==""){
        myAlert('テキストを入力してください');
        obj.disabled=null;
    }else{
        document.getElementById("FunEventsReadWhat").value=1;
        obj.form.submit();
    }
}
function FunEventsReadSubmitClick(obj){
    obj.disabled=true;
    var ok=1;
    for(var i=0;i<20;i++){
        if(document.getElementById('FunEventsRead'+i).value==""){
            ok=0;
            break;
        }    
    }
    if(ok==0){
        myAlert('20単語を入力してください');
        obj.disabled=null;
    }else{
        document.getElementById("FunEventsReadWhat").value=2;
        obj.form.submit();
    }
}
