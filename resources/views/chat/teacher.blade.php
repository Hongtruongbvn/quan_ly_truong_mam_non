<link rel="stylesheet" href="{{ asset('css/ChatTeacher.css') }}">

<div class="chat-parent-container">
    <div class="top-bar">
        <button id="back-button" class="btn-back">← Quay về</button>
        <h2 class="chat-title">Trò chuyện giáo viên</h2>
    </div>

    @if(session('success'))
        <div class="alert-success-box">
            {{ session('success') }}
        </div>
    @endif

    <div class="teacher-list-wrapper">
        <ul class="teacher-list">
            @foreach($parents as $parent)
                <li class="teacher-item">
                    <a href="javascript:void(0)" 
                       onclick="openChat({{ $parent->id }}, '{{ $parent->name }}', 'parent')" 
                       class="teacher-link">
                        <div class="teacher-avatar">
                            <img src="{{ url('storage/' .  $parent->img) }}" alt="Ảnh phụ huynh">
                        </div>
                        <span class="teacher-name">{{ $parent->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="chat-box" class="chat-box" style="display: none;">
        <div class="chat-header">
            <h3 id="chat-with" class="chat-with"></h3>
        </div>
        <div id="messages" class="messages"></div>
        <form id="chat-form" class="chat-form">
            <input type="hidden" name="receiver_id" id="receiver_id">
            <div class="chat-input-group">
                <textarea name="message" id="message" rows="2" placeholder="Nhập tin nhắn của bạn..." class="message-input"></textarea>
                <button type="submit" class="send-button">Gửi</button>
            </div>
        </form>
    </div>
</div>

<style>
/* Bố cục chính */
.chat-parent-container {
    max-width: 900px;
    margin: 30px auto;
    padding: 24px;
    background: #fff0f5;
    border-radius: 24px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* Thanh trên cùng */
.top-bar {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.btn-back {
    background: #ff69b4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-back:hover {
    background: #e05297;
    transform: scale(1.02);
}

.chat-title {
    font-size: 24px;
    font-weight: bold;
    color: #d63384;
    margin: 0;
    flex: 1;
    text-align: center;
}

/* Thông báo thành công */
.alert-success-box {
    background: #d4edda;
    color: #155724;
    padding: 12px 20px;
    border-radius: 16px;
    margin-bottom: 20px;
    border-left: 5px solid #28a745;
    font-size: 14px;
}

/* Danh sách phụ huynh dạng lưới */
.teacher-list-wrapper {
    margin-bottom: 24px;
}

.teacher-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 16px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.teacher-item {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.teacher-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.teacher-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px 12px;
    text-decoration: none;
}

.teacher-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 12px;
    border: 3px solid #ff69b4;
}

.teacher-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.teacher-name {
    font-size: 15px;
    font-weight: bold;
    color: #333;
    text-align: center;
}

/* Khung chat */
.chat-box {
    background: white;
    border-radius: 24px;
    padding: 20px;
    margin-top: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.chat-header {
    border-bottom: 2px solid #ffe0f0;
    padding-bottom: 12px;
    margin-bottom: 16px;
}

.chat-with {
    font-size: 18px;
    color: #d63384;
    margin: 0;
}

.messages {
    height: 350px;
    overflow-y: auto;
    padding: 12px;
    background: #fef9fc;
    border-radius: 16px;
    margin-bottom: 16px;
}

.message {
    max-width: 75%;
    margin-bottom: 12px;
    padding: 10px 14px;
    border-radius: 20px;
    word-wrap: break-word;
    font-size: 14px;
}

.message-right {
    background: #ff69b4;
    color: white;
    margin-left: auto;
    text-align: right;
    border-bottom-right-radius: 4px;
}

.message-left {
    background: #f0f0f0;
    color: #333;
    margin-right: auto;
    text-align: left;
    border-bottom-left-radius: 4px;
}

.chat-input-group {
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

.message-input {
    flex: 1;
    padding: 12px;
    border: 1px solid #ffc0e0;
    border-radius: 24px;
    font-size: 14px;
    resize: none;
    font-family: inherit;
}

.message-input:focus {
    outline: none;
    border-color: #ff69b4;
}

.send-button {
    background: #ff69b4;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.2s;
}

.send-button:hover {
    background: #e05297;
    transform: scale(1.02);
}

/* Responsive */
@media (max-width: 600px) {
    .chat-parent-container {
        padding: 16px;
        margin: 16px;
    }
    .teacher-list {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    .message {
        max-width: 90%;
    }
    .chat-input-group {
        flex-direction: column;
    }
    .send-button {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    let lastMessageId = 0;

    const fetchChatHistory = (receiverId) => {
        fetch(`/chat-history/${receiverId}`)
            .then(res => res.json())
            .then(messages => {
                const messagesDiv = document.querySelector('#messages');
                messagesDiv.innerHTML = '';
                messages.forEach(msg => {
                    const div = document.createElement('div');
                    div.classList.add('message', msg.sender_id === {{ auth()->id() }} ? 'message-right' : 'message-left');
                    div.textContent = msg.sender_id === {{ auth()->id() }} ? `Bạn: ${msg.message}` : `Người gửi: ${msg.message}`;
                    messagesDiv.appendChild(div);
                    lastMessageId = msg.id;
                });
                messagesDiv.scrollTop = messagesDiv.scrollHeight;
            })
            .catch(console.error);
    };

    const startPolling = (receiverId) => {
        setInterval(() => {
            fetch(`/get-new-messages`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify({ receiver_id: receiverId, last_message_id: lastMessageId })
            })
                .then(res => res.json())
                .then(messages => {
                    const messagesDiv = document.querySelector('#messages');
                    messages.forEach(msg => {
                        const div = document.createElement('div');
                        div.classList.add('message', msg.sender_id === {{ auth()->id() }} ? 'message-right' : 'message-left');
                        div.textContent = msg.sender_id === {{ auth()->id() }} ? `Bạn: ${msg.message}` : `Người gửi: ${msg.message}`;
                        messagesDiv.appendChild(div);
                        lastMessageId = msg.id;
                    });
                    messagesDiv.scrollTop = messagesDiv.scrollHeight;
                })
                .catch(console.error);
        }, 2000);
    };

    document.querySelector('#chat-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const receiverId = document.querySelector('#receiver_id').value;
        const message = document.querySelector('#message').value;

        fetch('/send-message', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ receiver_id: receiverId, message })
        })
            .then(() => {
                fetchChatHistory(receiverId);
                document.querySelector('#message').value = '';
            })
            .catch(console.error);
    });

    document.querySelector('#back-button').addEventListener('click', () => window.history.back());

    window.openChat = (receiverId, receiverName) => {
        document.querySelector('#chat-box').style.display = 'block';
        document.querySelector('#chat-with').innerText = `Trò chuyện với ${receiverName}`;
        document.querySelector('#receiver_id').value = receiverId;
        fetchChatHistory(receiverId);
        startPolling(receiverId);
    };
});
</script>