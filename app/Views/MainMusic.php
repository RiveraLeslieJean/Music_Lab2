<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Music</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/include/styles.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('public/include/js/script.js') ?>"></script>

    <style>
        body {
            font-family: 'Georgia', serif;
            background-image: linear-gradient(#a0a3fc49, #8200a338);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: right;
            height: 100vh;
        }

        h1 {
            color: #800080;
            font-size: 32px;
            margin-bottom: 20px;
            font-style: italic;
            text-align: center;
        }

        .modal-content {
            background-color: #fff;
            border-radius: 5px;
        }

        .modal-header {
            background-color: #800080;
            color: #fff;
            border-bottom: none;
            padding: 15px;
        }

        .modal-footer {
            background-color: #e6e6ff;
            border-top: none;
            padding: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .input-group {
            margin-top: 80px;
            width: 100%;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            border: 2px double #ccc;
            border-radius: 15px 3px 15px 3px;
            padding: 10px;
        }

        .btn-primary {
            background-image: linear-gradient(#BDBCE9, #8A2BE2);
            margin-top: 3px;
            border: 3px double #ccc;
            border-radius: 15px 5px 15px 5px;
            padding: 5px;
        }

        .btn-primary:hover {
            background-color: #4b0082;
        }

        #player-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        audio {
            width: 100%;
            margin-top: 20px;
        }

        #playlist {
            font-family: 'Georgia';
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        #playlist li {
            font-family: 'Georgia' #ffffff;
            cursor: pointer;
            padding: 10px;
            border-radius: 10px 5px 5px 10px;
            margin: 5px 0;
            transition: background-color 0.2s ease-in-out;
        }

        #playlist li:hover {
            background-color: #ccc;
        }

        #playlist li.active {
            background-color: #800080;
            color: #fff;
        }

        .button-space {
            margin-right: 10px;
        }
    </style>

</head>

<body>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <ul class="list-unstyled mt-3">
                        <?php foreach ($playlists as $play) : ?>
                            <li>
                                <a href="/playlists/<?= $play['id'] ?>">
                                    <?= $play['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <br>
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal">Close</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New</a>
                </div>
            </div>
        </div>
    </div>
    <form action="/search" method="get">
        <div class="input-group ">
            <input type="search" name="title" class="form-control" placeholder="Search for a song" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>


    <h1>Les Music Player</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        My Playlist
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadSong">
        Upload Song
    </button>

    <h1 id="currentTrackTitle"></h1>
    <audio id="audio" controls autoplay type="audio/mpeg"></audio>

    <ul class="list-unstyled mt-3" id="playlist">
        <?php foreach ($music as $mus) : ?>
            <li class="align-items-center" data-src="/<?= $mus['file_path'] ?>">
                <a href="#" id="music" class="play-link" data-music-id="<?= $mus['id'] ?>">
                    <?= $mus['title'] ?>
                </a>
                <button class="open-modal btn btn-primary" data-target="#mymodal" data-toggle="modal" data-music-id="<?= $mus['id'] ?>">
                    +
                </button>

            </li>
        <?php endforeach; ?>
    </ul>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Select from playlist</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <div class="modal-body">
                    <form action="/add" method="post">
                        <input type="hidden" id="musicID" name="musicID" value="">
                        <select name="playlist" class="form-control">
                            <?php foreach ($playlists as $play) : ?>
                                <option value="<?= $play['id'] ?>"><?= $play['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" name="add">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
         
            const modal = $("#myModal");
            const musicID = $("#musicID");

            function openModalWithMusicID(dataId) {
                musicID.val(dataId);
                modal.modal("show"); 
            }

          
            $(".open-modal").click(function(event) {
                event.preventDefault(); 
                const musicId = $(this).data("music-id");
                openModalWithMusicID(musicId);
            });

            modal.on("hide.bs.modal", function() {
                musicID.val(""); 
            });
        });
    </script>

    <script>
        const audio = document.getElementById('audio');
        const playlist = document.getElementById('playlist');
        const playlistItems = playlist.querySelectorAll('li');
        const currentTrackTitle = document.getElementById('currentTrackTitle');
        let currentTrack = 0;

        function playTrack(trackIndex) {
            if (trackIndex >= 0 && trackIndex < playlistItems.length) {
                const track = playlistItems[trackIndex];
                const trackSrc = track.getAttribute('data-src');
                const trackTitle = track.textContent;
                audio.src = trackSrc;
                audio.play();
                currentTrack = trackIndex;
                currentTrackTitle.textContent = trackTitle;
            }
        }

        function nextTrack() {
            currentTrack = (currentTrack + 1) % playlistItems.length;
            playTrack(currentTrack);
        }

        function previousTrack() {
            currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
            playTrack(currentTrack);
        }

        playlistItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                playTrack(index);
            });
        });

        audio.addEventListener('ended', () => {
            nextTrack();
        });

        playTrack(currentTrack);
    </script>

    <!-- Create Playlist -->
    <div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="createPlaylistLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPlaylistLabel">Create Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createPlaylistForm" action="/create" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Create">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#createPlaylistButton').click(function() {
                var name = $('#name').val();
                $('#createPlaylist').modal('hide');
            });
        });
    </script>
    <!-- upload-->

    <div class="modal fade" id="uploadSong" tabindex="-1" aria-labelledby="uploadSongLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadSongLabel">Upload a Song</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="\upload" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title of the Song</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="artist" class="form-label">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".mp3" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Song</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>