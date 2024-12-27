<x-app-layout>

    <h2 class="threadList">いいね検証</h2>
                    <i class="fab fa-twitter"></i>
    <div class="each">
            <div class=" thread border-4 border-blue-400 rounded-lg p-4 shadow-md flex flex-col items-start">
                <div class="yoko">
                    <!-- いいね -->
                    @if(1)
                    <div class="flexbox like-btn">
                        <i class="fas fa-gift liked" id="1"></i>
                        <p class="count-num">405</p>
                    </div>
                    @else
                    <div class="flexbox">
                        <i class="fa-regular fa-heart like-btn" id="1"></i>
                        <p class="count-num">404</p>
                    </div>
                    @endif
                </div>   
            </div>
        <!-- </ul> -->
    </div>

   
<script>
        // いいねボタンのhtml要素を取得
        const likeBtns = document.querySelectorAll('.like-btn');
        likeBtns.forEach(likeBtn => {
            likeBtn.addEventListener('click', async (e) => {
                const clickedEl = e.target;
                clickedEl.classList.toggle('liked');
                const threadId = clickedEl.id;
                console.log("like");

                const res = await fetch('/liketest', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ thread_id: threadId })
                })
                .then(res => {
                    if (res.status == 419) {
                        console.log("せんい");
                        window.location.reload();
                        // window.location.assign("../login");
                    }
                    return res.json()
                })
                .then(data => {
                    // if( data==="skip" ) { return "405" }
                    clickedEl.nextElementSibling.innerHTML = data.likesCount;
                })
                .catch(() => alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'));
            });
        });
   
</script>


</x-app-layout>

