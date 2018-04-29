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
                <h2><?= $kasus['nama'] ?></h2>
                <p>#<?= $kasus['id'] ?> - <?= $kasus['karyawan_nama']?:"<i>belum ada karyawan terassign</i>" ?></p>
                <section name="info-lawan" class="mt-5">
                    <?php if($user['role'] == 'client'): ?>
                    <?php if($kasus['karyawan_id']): ?>
                    <p>Anda sedang dilayani oleh</p>
                    <div class="panel pelayanan">
                        <div class="row">
                            <div class="col-xs-3 col-xl-2">
                                <img class="profile-pict" src="<?= Helper\Gravatar::get_gravatar($kasus['karyawan_email']) ?>" alt="">
                            </div>
                            <div class="col-xs-9 col-xl-10">
                                <p class="nama"><?=$kasus['karyawan_nama']?></p>
                                <p>#<?=$kasus['karyawan_id']?></p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <p>Harap tunggu sistem kami sedang menunggu respon dari tim helpdesk.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Anda sedang melayani</p>
                    <div class="panel pelayanan">
                        <div class="row">
                            <div class="col-xs-3 col-xl-2">
                                <img class="profile-pict" src="<?= Helper\Gravatar::get_gravatar($kasus['klien_email']) ?>" alt="">
                            </div>
                            <div class="col-xs-9 col-xl-10">
                                <p class="nama"><?=$kasus['klien_nama'] ?></p>
                                <p>#<?= $kasus['klien_id'] ?></p>
                            </div>
                        </div>
                    </div>
                    <p>Karyawan yang melayani:</p>
                    <?php if($kasus['karyawan_id']): ?>
                    <div class="panel pelayanan">
                        <div class="row">
                            <div class="col-xs-3 col-xl-2">
                                <img class="profile-pict" src="<?= Helper\Gravatar::get_gravatar($kasus['karyawan_email']) ?>" alt="">
                            </div>
                            <div class="col-xs-9 col-xl-10">
                                <p class="nama"><?=$kasus['karyawan_nama']?></p>
                                <p>#<?=$kasus['karyawan_id']?></p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <p><b>PERHATIAN: Belum ada yang di assign ke kasus ini!!</b></p>
                    <?php endif; ?>
                <?php endif; ?>
                    
                </section>
                <section name="call-to-action" class="mt-5">
                <?php if($kasus['closed_at']): ?>
                    <button class="btn btn-dark btn-block" disabled>Tiket sudah ditutup</button>                    
                <?php else:
                        if($user['role'] == 'client' || $user['role'] == 'pemimpin'):
                    ?>
                        <button class="btn btn-warning btn-block" data-trigger="tutup">Tutup Tiket</button>
                    <?php elseif($user['role'] == 'karyawan'): ?>
                        <?php if($kasus['karyawan_id'] == $user['id']): ?>
                        <button class="btn btn-primary btn-block" disabled data-trigger="self-assign">Anda sedang melayani tiket ini</button>                        
                        <?php else: ?>
                        <button class="btn btn-primary btn-block" data-trigger="self-assign">Layani Tiket</button>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($user['role'] == 'pemimpin'): ?>
                        <button class="btn btn-primary btn-block" data-trigger="assign">Assign Karyawan</button>
                    <?php endif; ?>
                <?php endif; ?>                
                </section>
            </div>
            <div class="col-xs-9 panel-chat">
                <section id="chat-lap">
                    <!-- nothing to do here -->
                </section>

                <!-- Chatbox! -->
                <section class="boxter">
                    <form action="chatbox.php" method="get" id="chatize" class="row middle-xs">
                        <div class="col-xs-11">
                            <textarea name="pesan" cols="30" rows="10" placeholder="Enter your message here"<?= ($kasus['closed_at'] || $user['role']=='pemimpin')?" disabled":"" ?>></textarea>
                        </div>
                        <div class="col-xs-1">
                            <button type="submit" class="btn btn-primary" <?= ($kasus['closed_at'] || $user['role']=='pemimpin')?" disabled":"" ?>>&gt;</a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <?= $this->include('_part/footer.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script>
        var kasus_id = <?= json_encode($_GET['id']?:0); ?>;
        var is_now_client = <?= json_encode($user['role'] == 'client')?>;
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
                            return chatbox.construct_new(chats.konten, (is_now_client)?!chats.is_client:chats.is_client, chats.created_at);
                        })
                        chatbox.appendAndScroll(data);
                    })
                },
                send_message: function() {
                    let message = $('textarea[name=\'pesan\']').val();
                    if(!message)
                        return;
                    $('textarea[name=\'pesan\']').attr("disabled", "disabled");
                    axios.post("chat_ajax.php", {konten:message, kasus:kasus_id}).then((e)=>{
                        let data = e.data.map((chats)=>{
                            chatbox.lastTime = Math.max(chatbox.lastTime, chats.created_at);
                            return chatbox.construct_new(chats.konten, (is_now_client)?!chats.is_client:chats.is_client, chats.created_at);
                        })
                        chatbox.appendAndScroll(data);
                        $('textarea[name=\'pesan\']').val("");
                        $('textarea[name=\'pesan\']').attr("disabled", null);
                    })
                }
            }
            $("form#chatize").submit((e)=>{
                e.preventDefault();
                chatbox.send_message();
            });
            setInterval(chatbox.refetch, 1000);


            //confirmation box
            $("[data-trigger='tutup']").click((e)=>{
                e.preventDefault();
                if(!confirm("Anda yakin menutup kasus?\nSetelah kasus ditutup, anda tidak dapat mengubah status kasus ini."))
                    return;
                $(this).text("Memproses...");
                $(this).attr("disabled", "disabled");
                axios.post("kasus_ajax.php", {case:kasus_id, action:'close'}).then((x)=>{
                    window.location.reload();
                }).catch(alert);
            });
            $("[data-trigger='self-assign']").click((e)=>{
                e.preventDefault();
                $(this).text("Memproses...");
                $(this).attr("disabled", "disabled");
                axios.post("kasus_ajax.php", {case:kasus_id, action:'self-assign'}).then((x)=>{
                    window.location.reload();
                }).catch(alert);
            });
            $("[data-trigger='assign']").click((e)=>{
                let username = prompt("Massukan email/username dari karyawan anda.");
                if(!username) {
                    alert("Assign dibatalkan.");
                    return;
                }
                let oldval = $(this).text();
                $(this).text("Memproses...");
                $(this).attr("disabled", "disabled");
                axios.post("kasus_ajax.php", {case:kasus_id, action:'assign', karyawan:username}).then((x)=>{
                    window.location.reload();
                }).catch((err)=>{
                    $(this).text(oldval);
                    $(this).attr("disabled", null);
                    alert("Error: " + err.response.data?err.response.data.error:err.statusText);
                });
            })
        });
    </script>
</body>
</html>