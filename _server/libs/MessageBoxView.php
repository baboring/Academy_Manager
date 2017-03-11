<style> 
.layout {
    padding: 80px;
	text-align: center;
    border:0px solid black;
}
.box_title {
	display: block;
	border: 0px solid darkblue;
	text-align: center;
	border-radius: 5px;
}
.box_title h1 {
    font-size:30px; 
    line-height:42px;
}
.MessageContents {
    padding:30px;
    height: 400px;
    vertical-align: middle;
}
.MessageBox {
	margin: 10px 20px;
	padding: 0 0px 30px 0;
	border-radius: 10px;
	box-shadow: 1px 1px 5px 1px black;
	
}
.MessageBox p {
    font-size:2.0em;
    padding: 10px 10px;
    line-height : 100%;
}
.clickButton {
    text-align: right;
    margin-right:50px;
}

</style>
        <div class="layout"t>
            <div class="MessageBox">
                <div class="box_title">
                    <h1 class="center_row"><?=$this->display_title?></h1><hr></div>
                <div calss="MessageContents">
                    <p><?=$this->display_contents?></p>
                <br>
                    </div>
                <div class="clickButton">
                <input type="button" class="button" onclick="<?=$this->onClick?>" value="<?=$this->button?>"></input> 
                </div>
            </div>
        </div>
    </div>
    