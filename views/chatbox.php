<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->include('_part/header.php'); ?>
    <style>
        .panel-info {
            background-color: white;
            padding: 20px 30px;
            border-right: 2px solid var(--border-color);
            height: calc(100vh - 49px);
        }

        .helper {
            opacity: 0.6;
            font-size: 0.8rem;
        }

        .panel-chat {
            overflow: auto;
            background-color: #42424275;
            padding-left: 0px;
            height: calc(100vh - 49px);
            padding-bottom: 109px;       
        }

        .pelayanan p {
            margin: 0px;
        }

        .pelayanan .nama {
            font-weight: 700;
        }

        .profile-pict {
            border-radius: 50%;
        }

        .panel-chat .msg {
            display: block;
            padding: 10px 30px;
        }

        .panel-chat .msg.gue {
            text-align: right;
        }

        .panel-chat .msg.dia {
            text-align: left;
        }

        .panel-chat .msg .item {
            display: inline-block;
        }

        .panel-chat .msg .item content {
            display: inline-block;
            background-color: #fff;
            border-radius: 6px;
            margin: 10px 5px 30px 5px;
            padding: 15px;
            position: relative;
            max-width: 70%;
        }

        .panel-chat .msg .item content time {
            display: block;
            font-size: 0.7rem;
            opacity: 0.6;
            position: absolute;
            bottom: -20px;
        }

        .panel-chat .msg.dia .item content time {
            right: 0;
        }
        .panel-chat .msg.gue .item content time {
            left: 0;
        }

        .boxter {
            position: fixed;
            bottom: 0px;
            background-color: white;
            width: 75%;
        }

        .boxter textarea {
            width: calc(100% - 45px);
            border: 0;
            height: 60px;
            margin: 15px;
            display:block;
            font-family: var(--font-fam);
        }
        .boxter textarea:focus {
            outline: none;
        }

    </style>
</head>
<body>
    <?= $this->include('_part/navbar.php'); ?>
    <div class="grid">
        <div class="row" style="margin: 0">
            <div class="col-xs-3 panel-info">
                <h2>Klaim Garansi</h2>
                <p>#<?= $kasus['id'] ?>- <?= $kasus['penulis'] ?></p>
                <section name="info-lawan" class="mt-5">
                    <p>Anda sedang dilayani oleh</p>
                    <div class="panel pelayanan">
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="profile-pict" src="<?= Helper\Gravatar::get_gravatar("christianto.g.14@gmail.com") ?>" alt="">
                            </div>
                            <div class="col-xs-10">
                                <p class="nama">Mark</p>
                                <p>#00201</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section name="call-to-action" class="mt-5">
                    <button class="btn btn-warning btn-block">Tutup Tiket</button>
                    <p class="helper">Anda selalu dapat membuka kembali tiket ini.</p>
                </section>
            </div>
            <div class="col-xs-9 panel-chat">
                <section id="chat-lap">

                </section>

                <!-- Chatbox! -->
                <section class="boxter">
                    <div class="row middle-xs">
                        <div class="col-xs-11">
                            <textarea name="" id="" cols="30" rows="10" placeholder="Enter your message here"></textarea>
                        </div>
                        <div class="col-xs-1">
                            <a class="btn btn-primary">&gt;</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?= $this->include('_part/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>
        var kasus_id = <?= json_encode($_GET['id']?:0); ?>
    </script>
    <script>
        $(document).ready(()=>{
            var chatbox = {
                lastTime: 0,
                construct_new: function(msg, placeLeft, time) {
                    var container = $("<div/>", {class:"msg"});
                    var box = $("<div/>", {class:"item"});
                    var content = $("<content/>", {text:msg});
                    var time = $("<time/>", {text:moment(time).format('hh:mm')});
                    content.append(time).appendTo(box);
                    box.appendTo(container);
                    if(!placeLeft)
                        container.addClass("gue");
                    else
                        container.addClass("dia");
                    return container;
                },
                appendAndScroll: function(chat) {
                    let lapangan = $("#chat-lap");
                    if(chat.constructor !== Array) {
                        chat = [chat];
                    }
                    chat.map((c)=>{
                        lapangan.append(c);
                        $(c).get(0).scrollIntoView(true);
                    })
                },
                refetch: function() {
                    axios.get("chat_ajax.php",{params: {
                        id: kasus_id,
                        last: chatbox.lastTime
                    }}).then((e)=>{
                        let data = e.data.map((chats)=>{
                            chatbox.lastTime = Math.max(chatbox.lastTime, chats.created_at);
                            return chatbox.construct_new(chats.konten, !chats.is_client, chats.created_at);
                        })
                        chatbox.appendAndScroll(data);
                    })
                }
            }

            setInterval(chatbox.refetch, 1000);
        });
    </script>
</body>
</html>