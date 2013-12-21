
<div id="msg"></div>
<div class="msg_content" id="msg_content">
	<p class="shut" ><span onclick="closepage100()">&nbsp;&nbsp;</span></p>
	<h2>您当前的账户余额是：<span id="my_moeny"></span>元</h2>
	<div onclick="closepage100()" id="returned">&nbsp; </div>
</div>
<div id="container">
<?php echo $this->fetch('library/user/user_top_menu.lbi'); ?>
	
	<div id="content">
		<p class="wane_left"></p>
		<p class="wane_right"></p>
		<div class="top_pu">
        <form action="user.php" name="myForm" id="myForm" method="post">
			
			<table class="top_pu1" border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td width="140">卡号：</td>
						<td colspan="2">
							<table>
								<tr>
									<td><input type="text" name="card_num1" id="card_num1" class="w50px"  onfocus="clear_message(this);" onkeyup="javascript:if(this.value.length==4) document.getElementById('card_num2').focus();" maxlength="4" value=""/></td>
									<td><input type="text" name="card_num2" id="card_num2" class="w50px" onfocus="clear_message(this);" onkeyup="javascript:if(this.value.length==4) document.getElementById('card_num3').focus();" value="" maxlength="4"/></td>
									<td><input type="text" name="card_num3" id="card_num3" class="w50px" onfocus="clear_message(this);" onkeyup="javascript:if(this.value.length==4) document.getElementById('card_num4').focus();" value="" maxlength="4"/></td>
									<td><input type="text" name="card_num4" id="card_num4" class="w50px" onfocus="clear_message(this);" value="" maxlength="4"/></td>
                                    <td><input type="hidden" name="card_num" id="card_num" value=""/><span style="color:red;" id="check_card_num">&nbsp;</span></td>
								</tr>
							</table>                            
						</td>
					</tr>
					<tr>
						<td>密码：</td>
						<td colspan="2">&nbsp;<input type="password" name="card_password" onfocus="clear_message(this);" id="card_password" class="w230px" /><span style="color:red;" id="check_card_password">&nbsp;</span></td>
					</tr>
					<tr>
						<td>移动电话：</td>
						<td colspan="2">&nbsp;<input type="text" name="mobile" id="mobile" onfocus="clear_message(this);"  value="<?php echo $this->_var['mobile']; ?>" class="w230px" /><span style="color:red;" id="check_mobile">&nbsp;</span></td>					
					</tr>
					<tr>
						<td>手机效验码：</td>
						<td colspan="2">
							<table>
								<tr>
									<td><input type="text" name="verify" id="verify" class="w130px" /></td>
									<td><input type="button" name="get_verify" id="get_verify" onclick="getVerify()" class="but" /></td>
								</tr>		
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td style="width:400px"><span style="color:red;" id="verify_message">&nbsp;</span></td>
					</tr>
					</tr>
						<th id="td11">&nbsp;</th>
						<td id="td12"><input type="button" class="top_pu_but" id="but" onclick="chargecard_do();"/></td>
						
					
					</tr>
				</tbody>
			</table><span style="color:red;" id="check_card">&nbsp;</span>
            <input name="act" type="hidden" value="chargecard_do">
        </form>
		</div>
	</div>
</div>
<script language="javascript" type="text/javascript">
window.onload=function(){
	//导航
	var Onav=document.getElementById('nav');
	var Ili=Onav.getElementsByTagName('li');
	for(var i=0;i<Ili.length;i++){
		Ili[i].index=i;
		Ili[i].onclick=function(){
			for(var i=0;i<Ili.length;i++){
				Ili[i].className='';
			}
			this.className='active';
		}
	}
	//弹出层
	var Omsg=document.getElementById('fullbg');
	var OmsgContent=document.getElementById('msg_content');
	var aP=OmsgContent.getElementsByTagName('p')[0];
	var aInput=OmsgContent.getElementsByTagName('input')[0];
	aP.onclick=None;
	aInput.onclick=None;
	function None(){
		Omsg.style.display='none';
		OmsgContent.style.display='none';
	}
	
};
function cardNumCheck(){
	var card_num1=document.getElementById("card_num1").value;
	var card_num2=document.getElementById("card_num2").value;
	var card_num3=document.getElementById("card_num3").value;
	var card_num4=document.getElementById("card_num4").value;
	var card_num=card_num1+card_num2+card_num3+card_num4;
	if(isNaN(card_num)||card_num.length!=16){
		return false;
	}else{
		return true;
	}
}
function chargecard_do(){
	var card_num1		= document.getElementById("card_num1").value;
	var card_num2		= document.getElementById("card_num2").value;
	var card_num3		= document.getElementById("card_num3").value;
	var card_num4		= document.getElementById("card_num4").value;
	var card_num		= card_num1+card_num2+card_num3+card_num4;
	var card_password	= document.getElementById("card_password").value;
	var check_card_password		= document.getElementById("check_card_password");
	var check_card_num	= document.getElementById("check_card_num");
	var mobile			= document.getElementById("mobile").value;
	var check_mobile	= document.getElementById("check_mobile");
	var verify_message		= document.getElementById("verify_message");
	var verify	        = document.getElementById("verify").value;
	if(card_num==""){
		check_card_num.innerHTML="* 卡号不能为空";
		return false;
	}
	if(!cardNumCheck()){
		check_card_num.innerHTML="* 卡号格式错误，请重新输入";
		return false;
	}
	if(card_password==""){
		check_card_password.innerHTML="* 请输入密码";
		return false;
	}
	if(mobile==""){
		check_mobile.innerHTML="* 请输入手机号";
		return false;
	}
	if(isNaN(mobile) || mobile.length!=11){
		check_mobile.innerHTML="* 手机号格式不正确";
	}
	if(verify=="")
	{
		verify_message.innerHTML="* 验证码不能为空";
		return false;
    }
	document.getElementById("card_num").value=card_num;
	Ajax.call('user.php?act=chargecard_do', 'card_num=' + card_num+'&card_password='+card_password+'&mobile=' + mobile + '&verify='+verify, return_chargecard_do, 'POST', 'JSON');
}
function return_chargecard_do(result){
	var check_card= document.getElementById("check_card");
	var verify_message		= document.getElementById("verify_message");
	if(result.error > 0)
	{
		alert(result.message);
		return false;
	}
	else{
		document.getElementById("my_moeny").innerHTML = result.user_money;
		var Omsg=document.getElementById('msg');
	    var OmsgContent=document.getElementById('msg_content');
		Omsg.style.display='block';
		OmsgContent.style.display='block';
	}
}
function clear_message(obj){
	var check_card_num	=document.getElementById("check_card_num");
	var check_card		= document.getElementById("check_card");
	var check_mobile	= document.getElementById("check_mobile");
	var verify_message	= document.getElementById("verify_message");
	if(obj.id=="card_num1"||obj.id=="card_num2"||obj.id=="card_num3"||obj.id=="card_num4"){
		check_card_num.innerHTML="&nbsp;";
	}else if(obj.id=="card_password"){
		check_card.innerHTML="&nbsp;";
	}else if(obj.id=="mobile"){
		check_mobile.innerHTML="&nbsp;";
	}else if(obj.id=="verify"){
		verify_message.innerHTML="&nbsp;";
	}
}
function getVerify(){
	var check_mobile	= document.getElementById("check_mobile");
	var get_verify		= document.getElementById("get_verify");
	var mobile          = document.getElementById("mobile").value;
	if(isNaN(mobile) || mobile.length!=11){
		check_mobile.innerHTML="* 手机号格式不正确";
	}else{
		Ajax.call( 'user.php?act=send_verify', 'mobile=' + mobile+"&num=2", get_verify_callback , 'GET', 'TEXT', true, true );
	}
	
}
var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数
function get_verify_callback(result){
	if(result!="0"){
		//alert(result);
		curCount = count;
		InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
		document.getElementById("verify_message").innerHTML="验证码已发送，请注意查收，"+curCount + "秒后可重新发送";
	}else{
		document.getElementById("verify_message").innerHTML="短信发送失败，重新发送";
		document.getElementById("get_verify").disabled=false;
	}
}
/*倒计时*/
function SetRemainTime() {
    if (curCount == 0) {   
        window.clearInterval(InterValObj);//停止计时器
        document.getElementById("get_verify").disabled='';//启用按钮
        document.getElementById("verify_message").innerHTML="&nbsp;";
    }
    else {
        curCount--;
		document.getElementById("get_verify").disabled=true;//启用按钮
		document.getElementById("verify_message").innerHTML="验证码已发送，请注意查收，"+curCount + "秒后可重新发送";
    }
}
//关闭弹出页面
function closepage100()
{
	var Omsg=document.getElementById('msg');
	    var OmsgContent=document.getElementById('msg_content');
		Omsg.style.display='none';
		OmsgContent.style.display='none';
		if(<?php echo $this->_var['re']; ?>)
		{window.location="flow.php?step=checkout";}
		else
		{window.location.reload();}

		
}
</script>