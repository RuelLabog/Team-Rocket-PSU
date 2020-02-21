<div class="home-page ">
    <!-- Home page header starts -->
    <nav>
    <div class="nav-wrapper teal lighten-2 col s12">
      <a href="#!" class="col s12 right">Welcome {{ data.username }}</a>
      <ul class="left hide-on-med-and-down">
        <!-- <li><a href="sass.html"><i class="material-icons col s3">search</i></a></li>
        <li><a href="badges.html"><i class="material-icons col s3">view_module</i></a></li>
        <li><a href="collapsible.html"><i class="material-icons col s3">refresh</i></a></li>
        <li><a href="mobile.html"><i class="material-icons col s3">more_vert</i></a></li> -->
        <li class="col s3">
            <span class="logout-user" ng-click="logout()">
            <i class="material-icons col s3 left-align" aria-hidden="true">power_settings_new</i>
            </span>
        </li>
      </ul>
    </div>
  </nav>
    <!-- Home page header ends -->

    <!-- Home page body start -->
    <div class="home-body">
        <div class="row" style="height: 100% !important;">
            <!-- Chat list Markup starts -->
            <div class="col s3" style="margin-left: 0px;">
                <div class="chat-list-container">
                    <p class="chat-list-heading"><h4 class="center-align">Chat list</h4> </p>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Search Conversation</label>
                    </div>

                    <div class="col s12 center-align">
                        <ul class="tabs">
                            <li class="tab col s6"><a href="#test1" class="active blue-text text-darken-4">Conversations</a></li>
                            <li class="tab col s6"><a href="#test2" class="blue-text text-darken-4">Personas</a></li>
                        </ul>
                    </div>

                    <div class="chat-list">
                        <div class="row">
                            <!-- <div class="col s12">
                              <ul class="tabs">
                                <li class="tab col s6"><a href="#test1">Conversations </a></li>
                                <li class="tab col s6"><a href="#test2">Services</a></li>
                              </ul>
                            </div> -->
                        </div>
                        <ul class="collection with-header left-align" ng-if="data.chatlist.length > 0">
                            <li class="collection-item truncate"
                                ng-repeat="friend in data.chatlist"
                                ng-click="selectFriendToChat(friend.id)"
                                ng-class="{'active':friend.id == data.selectedFriendId}"
                            >{{friend.username}}</li>
                        </ul>
                        <div class="alert alert-info" ng-if="data.chatlist.length !!= 0">
                            <!-- <strong>No one is online to chat, ask someone to Login.</strong> -->
                            <strong>No conversation available.</strong>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chat List Markup ends -->

            <!-- Message Area Markup starts -->
            <div class="col s9" >
                <div class="message-container2" ng-if="data.messages.length == 0">
                    <div class="message-list">
                        <ul class="message-thread center-align">
                            <div class="section"></div>
                            <div class="section"></div>
                            <div class="section"></div>
                            <div class="section"></div>
                            <h1><b>Welcome, {{ data.username }}.</b></h1>
                            <h5>Please select a conversation</h5>
                            <img class="center-align" src="https://media.giphy.com/media/bcKmIWkUMCjVm/giphy.gif" alt="" style="bottom: 0px;left:750px;position: absolute;">
                        </ul>
                    </div>

                </div>



                <div class="message-container" ng-if="data.messages.length > 0">
                    <span id="fixx">
                    <h5 class="collection-item truncate"
                    ng-class="{'active':friend.id == data.selectedFriendId}"
                    >{{data.selectedFriendName}}</h5>
                    </span>
                    <div class="message-list">
                        <ul class="message-thread">
                            <!-- <div id="fiexe">
                                <span ng-show="data.selectedFriendId !== null" ? true : false >
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <h2 class="message-heading"> Chat History With {{data.selectedFriendName}}</h2>
                                </span>
                            </div> -->
                            <li ng-repeat="messagePacket in data.messages"
                                ng-class="{ 'align-right' : alignMessage(messagePacket.fromUserId) } ">
                                {{messagePacket.message}}
                            </li>
                        </ul>
                    </div>


                    <div class="message-text">


                        <!-- <div class="col s11 align-left" >
                        <textarea id="message" name="message"

                        placeholder="Type a message"
                        ng-keydown="sendMessage($event)"></textarea>

                        </div> -->



                        <div class="input-field col s11">
                            <i class="material-icons prefix">message</i>
                            <textarea id="message" name="message" type="text" class="materialize-textarea" ng-keydown="sendMessage($event)"></textarea>
                            <label for="message">Type a message</label>
                        </div>


                        <div class="col s1 align-left" >
                        <button id="submit" class="waves-effect waves-light btn-large" type="submit" name="submit">
                        <!-- <a class="waves-effect waves-light btn-small"><i class="material-icons right">cloud</i>button</a> -->
                        <i class="material-icons left-align">send</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Message Area Markup ends -->


    </div>
</div>


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

#submit {
    border-radius: 50%;
    height: 50px;

    margin-top: 5px;

    display: inline;
}
#fixx{
    margin-bottom: 1%;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
