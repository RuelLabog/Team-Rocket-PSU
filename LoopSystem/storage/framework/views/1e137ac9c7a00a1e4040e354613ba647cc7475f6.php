<?php $__env->startSection('content'); ?>
<!-- Compiled and minified JavaScript -->
      
<div class="home-page ">
    <!-- Home page header starts -->

    <nav >
        <div class="nav-wrapper teal lighten-2 col s12">
          <a href="" class="brand-logo left">Welcome <?php echo e(auth()->user()->username); ?></a>
          <ul class="right hide-on-med-and-down ">
            <li class="right">
                <!-- <span class="logout-user" ng-click="logout()"> -->
                <a class="logout-user " id="logout-user" href="<?php echo e(route('logout')); ?>"
                onclick="event.preventDefault();logout();
                document.getElementById('logout-form').submit();">
                <i class="material-icons" aria-hidden="true">power_settings_new</i>
                </a>
                
                <br><br><br>
                <?php if(auth()->user()->user_type == "operator"): ?>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none" >
                <?php else: ?>
                <form id="logout-form" action="<?php echo e(route('logoutSubs')); ?>" method="POST" style="display: none" >
                <?php endif; ?>
                <?php echo csrf_field(); ?>

                <input type="submit" value="Logout">
                </form>

            </li>
          </ul>
        </div>
      </nav>

    <!-- Home page header ends -->

    <!-- Home page body start -->
    <div class="home-body">
        <div class="row" style="height: 100% !important; margin-bottom:0px;">
            <!-- Chat list Markup starts -->
            <div class="row" style="width:30%; margin-bottom:0px;">
                <div class="chat-list-container z-depth-2 col 12" style="height: 100% !important; ">
                    <p class="chat-list-heading"><h4 class="center-align"><b>Chat list</b></h4> </p>
                    

                    <div class="chat-list col 3">

                        <ul class="collection with-header left-align" ng-if="data.chatlist.length > 0" id="users">
                            <!-- <li class="collection-item truncate active"
                            >User12345687</li> -->
                        </ul>
                        <!-- <div class="alert alert-info" ng-if="data.length !!= 0"> -->
                            <!-- <strong>No one is online to chat, ask someone to Login.</strong> -->
                            <!-- <strong>No conversations available.</strong> -->
                        <!-- </div> -->
                        <!-- <h1 id='m'></h1> -->
                    </div>



                    

                </div>
            </div>
            <!-- Chat List Markup ends -->

            <!-- Message Area Markup starts -->
            <div class="" style="width:70%; height:100%;">
                <div class="message-container2" ng-if="data.messages.length == 0" style="padding: 20px 0px 20px 20px;
                background-color: rgb(255, 255, 255);
                margin: 10px 0px 10px 10px;
                height: 104%;">
                    <div id="chatName"></div>
                    <div class="message-list">
                        <ul class="message-thread center-align" style="overflow-y: auto;
                        list-style-type: none;
                        height: 95%;
                        width: 100%;
                        margin: 0px !important;
                        padding: 5px !important;
                        border-radius: 5px;
                        border: #ffffff;">

                            <div class="chat" id="chat" style="height:30rem; overflow-y:auto;"><h3><b>Welcome, <?php echo e(auth()->user()->username); ?>.</b></h3>
                                <h6>Please wait for a user.</h6>
                                <img class="center-align" src="https://media.giphy.com/media/bcKmIWkUMCjVm/giphy.gif" alt="" height="73%">

    </div>




                        </ul>
                    </div>

                </div>



                


                    <div class="message-text">
                        <form id="messageForm">
                        <div class="input-field col s11">
                            <i class="material-icons prefix">message</i>
                            <textarea id="message" name="message" type="text" class="materialize-textarea" ng-keydown="sendMessage($event)"></textarea>
                            <label for="message">Type a message</label>
                        </div>


                        <div class="col s1 align-left" >
                            <button id="submitmessage" class="waves-effect waves-light btn-small" type="submit" name="submit">

                            <i class="material-icons">send</i>
                        </div>
                        </form>
                    
                </div>
            </div>
        </div>
            <!-- Message Area Markup ends -->


    </div>
</div>


  <!-- Modal Structure -->
  


<style>
    /* #message {
    border-radius: 25px;
    background-color: eeeeee;
    padding: 20px;
     height: 20px;
    width: 1020px;
    resize: none;
    overflow:hidden;
    outline-width: 0;
    display: inline;

} */

#submitmessage {
    border-radius: 20%;
    height: 50px;

    margin-top: 10px;

    display: inline;
}
#fixx{
    margin-bottom: 1%;
}
#chat{
    overflow-y: auto;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<script>
     var instance = M.Tabs.init(el, options);
     var instance = M.Tabs.getInstance(elem);
     instance.select('tab_id');
     instance.updateTabIndicator();

// Or with jQuery

$(document).ready(function(){
  $('.tabs').tabs();
});
</script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<script type="text/javascript" src="http://localhost:8000/socket.io/socket.io.js"></script>
    <script>
  //var socket = io('http://localhost:8000');




</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>

<script type="text/javascript">
 var socket = io('http://localhost:8000');
 var $sendBtn = $('#submitmessage');
    $(function(){

        //var socket = io.connect();
        var $chatName= $('#chatName');
        var $chat = $('#chat');
        var $username = $('#username');
        var $users = $('#users');
        var $message = $('#message');
        var $messageForm = $('#messageForm');
        var $m = $('#m');




        socket.on('connectToRoom',function(data) {
            var html = data;
            $m.html(html);
            $m.val(data);
        });


        $messageForm.submit(function(e){
            e.preventDefault();
            socket.emit('send messageOps', {message:$message.val(), roomno: $m.val(),subs_id:'<?php echo e(auth()->user()->id); ?>', con_id: $('#submitmessage').val()});
            // alert($('#submitmessage').val());
			$message.val("");
            $message.focus();
        });

        //message
        socket.on('new message', function(data){
            // $chat.append('<div class="card card-body bg-light"><b>'+data.user+': </b>' + data.msg + '</div>');
            if(data.id == '<?php echo e(auth()->user()->id); ?>'){
                $chat.append('<li style="max-width: 300px;border-color: solid 0.5px rgba(0, 0, 0, 0.32);clear: both;text-decoration: none;list-style-type: none;margin: 20px 10px 0px 20px;float: right;margin-right: 20px;padding: 25px 34px;min-width: 160px;min-height: 10px;max-width: 350px;border:solid 1px #0000001f;background-color: eeeeee;line-height: 1.4;word-wrap: break-word;color: #444444;text-align: left;border-radius: 25px;"> <span class="align-right"><br/><small>'+moment().format('llll')+'</small></span>' + data.msg +'</li>');
            }else{
                $chat.append('<li style="max-width: 300px;border-color: solid 0.5px rgba(0, 0, 0, 0.32);clear: both;text-decoration: none;list-style-type: none;margin: 20px 10px 0px 20px;float: left;margin-right: 20px;padding: 25px 34px;min-width: 160px;min-height: 10px;max-width: 350px;border:solid 1px #0000001f;background-color: eeeeee;line-height: 1.4;word-wrap: break-word;color: #444444;text-align: left;border-radius: 25px;"> <span class="align-right"><br/><small>'+moment().format('llll')+'</small></span>' + data.msg +'</li>');
            }
            scrollToBottom();
        });


        socket.emit('login user', ['<?php echo e(auth()->user()->id); ?>', '<?php echo e(auth()->user()->username); ?>', '<?php echo e(auth()->user()->user_type ?? 'subscriber'); ?>'], function(data){
            //Auto disconnect
            // setTimeout(function(){ $('.modal').modal(); }, 60000);
        });

        // socket.on('get users', function(data){
        //     var html = '';
        //     for(i =0 ; i <data.length;i++){
        //         html += '<li class="collection-item truncate active">'+data[i]+'</li>';
        //     }
        //     $users.html(html);
        // });

        socket.on('showrowsSubs', function(rows) {
        var html='';
        if(rows.length > 0){
            for (var i=0; i<rows.length; i++) {
                 html += '<li class="collection-item truncate active" onclick="getMessages('+rows[i].con_id+')">'+rows[i].subscriber_name+'</li>';
            }
        }else{
            html += '<div class="alert alert-info" ng-if="data.length !!= 0">'+
                            '<strong>No conversations available.</strong>'+
                        '</div>';
        }

         $users.html(html);
        });

        socket.emit('getChatSubscriber', '<?php echo e(auth()->user()->id); ?>', (data)=>{});

        socket.on('showName', (data)=>{
            var html = '<h4><b>'+data[0].subscriber_name+'</b></h4>';
           $chatName.html(html);

        });


    socket.on('showMessages', (data)=>{

        var html = '';
        for(var i=0; i < data.length; i++ ){
            if(data[i].user_id == '<?php echo e(auth()->user()->id); ?>'){
                html += '<li style="max-width: 300px;border-color: solid 0.5px rgba(0, 0, 0, 0.32);clear: both;text-decoration: none;list-style-type: none;margin: 20px 10px 0px 20px;float: right;margin-right: 20px;padding: 25px 34px;min-width: 160px;min-height: 10px;max-width: 350px;border:solid 1px #0000001f;background-color: eeeeee;line-height: 1.4;word-wrap: break-word;color: #444444;text-align: left;border-radius: 25px;"> <span class="align-right"><br/><small>'+moment(data[i].date_outbound).format('llll')+'</small></span>' + data[i].message +'</li>';
            }else{
                html += '<li style="max-width: 300px;border-color: solid 0.5px rgba(0, 0, 0, 0.32);clear: both;text-decoration: none;list-style-type: none;margin: 20px 10px 0px 20px;float: left;margin-right: 20px;padding: 25px 34px;min-width: 160px;min-height: 10px;max-width: 350px;border:solid 1px #0000001f;background-color: eeeeee;line-height: 1.4;word-wrap: break-word;color: #444444;text-align: left;border-radius: 25px;"> <span class="align-right"><br/><small>'+moment(data[i].date_outbound).format('llll')+'</small></span>' + data[i].message +'</li>';
            }

            // $chat.append('<li style="max-width: 300px;border-color: solid 0.5px rgba(0, 0, 0, 0.32);clear: both;text-decoration: none;list-style-type: none;margin: 20px 10px 0px 20px;float: left;margin-right: 20px;padding: 25px 34px;min-width: 160px;min-height: 10px;max-width: 350px;border:solid 1px #0000001f;background-color: eeeeee;line-height: 1.4;word-wrap: break-word;color: #444444;text-align: left;border-radius: 25px;"> <span class="align-right"><b>'+moment(data[i].date_outbound).format('llll')+'</b></span>' + data[i].message +'</li>');
            scrollToBottom();
            // console.log('msg :' + data[i].message + "date: " + data[i].date_outbound);
        }

        $chat.html(html);
    });


    });




function getMessages(id){
    //alert(id);
    $sendBtn.val(id);
    socket.emit('getMessages', id);
    socket.emit('getChatNameSub', id);
}

function scrollToBottom(){
        const messageThread = document.querySelector('.chat');
        setTimeout(() => {
            messageThread.scrollTop = messageThread.scrollHeight + 500;
        }, 10);
    }

function logout(){
     socket.emit('logout user', ['<?php echo e(auth()->user()->id); ?>', '<?php echo e(auth()->user()->username); ?>', '<?php echo e(auth()->user()->user_type ?? 'subscriber'); ?>'], function(data){
        //...
     });
}

</script>





<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Repository\LoopSystem\resources\views/pages/OperatorHome.blade.php ENDPATH**/ ?>