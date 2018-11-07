
        <div class="introduction">
          <p>I created a hangman game based on Php. An object created with a Php class and stored inside a session, interacts with
            the input received from the user via Ajax calls. Source code for the game including a log in solution and historical score
             can be found <a href="https://github.com/PaulCrisan/hangM"style="color:#B70000"
              >here</a>.
           </p>
        </div>
        <div class="container index">

            <?php echo $currUser ?>
            <div <?php echo $hidden ?> class="links">
            </div>
            <div class="border s  ">
                <p class="mar-bott txt title">Guess the following php function:</p>
                <p id="descr_fromUrl" class="mar-bott txt"></p>
            </div>
            <div class="divider"></div>
            <div class="flex-start">
                <button id="hint" class="button-click" type="button" name="button">Hint</button>
                <?php for ($i = 0; $i < $_SESSION['game']->getGuessStringCount()  ; $i++) {
                  echo "<span id = '$i' class='title bold marL' > $displayblock</span>";
                  }
           ?>
            </div>
            <p class="txt title mt">Used characters:</p>
            <p id="usedChars_" class="txt "></p>
            <div class="display-row">
                <div class="flex-start notop">
                    <input id="char-input" class="input guess" type="text" name="" value="" max="1" maxlength="1">
                    <button id="checkButton" class="button-click" type="button" name="button">Check</button>
                    <div class="hidden-s winS">
                        <img id="win" class="end" src="../public/images/win.png" alt="win">
                    </div>
                    <div class="hidden-s failS">
                        <img id="lost" class="end" src="../public/images/fail.png" alt="fail">
                    </div>
                </div>
                <div class="margin-l im">
                    <img class="hang-img" src="../public/images/hangP/11.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/10.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/9.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/8.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/7.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/6.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/5.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/4.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/3.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/2.png" alt="">
                    <img class="hang-img" src="../public/images/hangP/1.png" alt="">
                </div>


            </div>
            <div class="display-row">
                <p class="txt title padd">Time left (min):</p>
                <p id="counter" class="title normal paddmax">
                    <?php echo $_SESSION['game']->getTimeLimit() ?>
                </p>
                <p class="txt title padd">Guesses left:</p>
                <p id="guesses_" class="title normal title">
                    <?php echo $_SESSION['game']->getNrOFGuesses() ?>
                </p>
            </div>
            <!-- tab-uri si buton de restart-->
            <div class="fl-start">
                <button id="restartBtn" class="button-click" type="button" name="button">Restart</button>
            </div>
            <div class="display-row self">

                <div id="statTab" class="tab2">
                    <p>user stats</p>
                </div>
                <div id="searchTab" class="tab2">
                    <p>time settings</p>
                </div>
            </div>
            <!-- sfarsit tab-uri si buton restart-->

            <!-- corpul tab-urilor -->
            <div class="stats">
                <div id="searchBody" class="hidden">
                    <form method="post">
                        <div class="button-click time">2 min(default)</div>
                        <div class="button-click time">3 min</div>
                        <div class="button-click time">4 min</div>
                    </form>
                </div>
                <div id="statsBody" class="hidden">
                    <!--  -->
                    <div id="chart-container" class="chart-elements">
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- sfarsit corp tab-uri -->
        </div>
