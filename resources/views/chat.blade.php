<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat dengan {{ $store->user->nama }} - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    :root {
        --primary-black: #000000;
        --primary-white: #ffffff;
        --soft-gray: #f8f9fa;
        --border-gray: #e9ecef;
        --text-gray: #6c757d;
        --message-sent: #000000;
        --message-received: #f1f3f4;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--primary-black);
        background: var(--soft-gray);
    }

    
    .navbar-modern {
        background: var(--primary-white) !important;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        padding: 1rem 0;
    }

    .navbar-brand img {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    .nav-link {
        color: var(--primary-black) !important;
        font-weight: 500;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: var(--text-gray) !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 50%;
        background-color: var(--primary-black);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border: 2px solid var(--primary-black);
        transition: all 0.3s ease;
    }

    .profile-img:hover {
        transform: scale(1.1);
        border-color: var(--text-gray);
    }

    .dropdown-menu {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
        margin-top: 0.5rem;
        background: var(--primary-white);
        min-width: 200px;
        backdrop-filter: blur(10px);
        animation: fadeInUp 0.3s ease;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        color: var(--primary-black) !important;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0.25rem 0.5rem;
        position: relative;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background: var(--primary-black) !important;
        color: var(--primary-white) !important;
        transform: translateX(5px);
    }

    .dropdown-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: var(--primary-black);
        transition: height 0.3s ease;
        border-radius: 2px;
    }

    .dropdown-item:hover::before {
        height: 100%;
        background: var(--primary-white);
    }

    .dropdown-divider {
        margin: 0.5rem 1rem;
        border-color: var(--border-gray);
    }

    .dropdown-item-icon {
        width: 16px;
        height: 16px;
        margin-right: 0.75rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .dropdown-item:hover .dropdown-item-icon {
        opacity: 1;
    }

    
    .chat-container {
        padding-top: 100px;
        min-height: 100vh;
        background: linear-gradient(135deg, var(--soft-gray) 0%, var(--primary-white) 100%);
    }

    .chat-wrapper {
        background: var(--primary-white);
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 2rem 0;
        border: 1px solid var(--border-gray);
    }

    .chat-header {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333333 100%);
        color: var(--primary-white);
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .chat-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--primary-white);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: absolute;
        top: 1rem;
        left: 1rem;
        backdrop-filter: blur(10px);
        z-index: 10;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .chat-user-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 2;
        margin-top: 1rem;
    }

    .chat-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 4px solid var(--primary-white);
        object-fit: cover;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .chat-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
    }

    .chat-user-details h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .chat-user-status {
        font-size: 1rem;
        opacity: 0.9;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .chat-messages {
        padding: 2.5rem;
        max-height: 65vh;
        overflow-y: auto;
        background: var(--primary-white);
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .message-date {
        text-align: center;
        color: var(--text-gray);
        font-size: 0.85rem;
        margin: 1rem 0;
        position: relative;
    }

    .message-date::before,
    .message-date::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 30%;
        height: 1px;
        background: var(--border-gray);
    }

    .message-date::before {
        left: 0;
    }

    .message-date::after {
        right: 0;
    }

    .message-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        animation: fadeInUp 0.5s ease;
    }

    .message-bubble {
        max-width: 75%;
        padding: 1.25rem 1.75rem;
        border-radius: 25px;
        position: relative;
        word-wrap: break-word;
        font-size: 1rem;
        line-height: 1.5;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .message-bubble:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .message-sent {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333333 100%);
        color: var(--primary-white);
        margin-left: auto;
        border-bottom-right-radius: 8px;
        position: relative;
    }

    .message-sent::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: -8px;
        width: 0;
        height: 0;
        border-left: 8px solid #333333;
        border-bottom: 8px solid transparent;
    }

    .message-received {
        background: var(--soft-gray);
        color: var(--primary-black);
        margin-right: auto;
        border-bottom-left-radius: 8px;
        border: 1px solid var(--border-gray);
        position: relative;
    }

    .message-received::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: -9px;
        width: 0;
        height: 0;
        border-right: 9px solid var(--soft-gray);
        border-bottom: 8px solid transparent;
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.7;
        margin-top: 0.5rem;
        text-align: right;
    }

    .message-received .message-time {
        text-align: left;
    }

    .input-container {
        background: var(--primary-white);
        border-radius: 50px;
        padding: 0.75rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        display: flex;
        align-items: end;
        gap: 1rem;
    }

    .chat-input-area {
        padding: 2rem;
        background: var(--soft-gray);
        border-top: 1px solid var(--border-gray);
    }

    .input-container:focus-within {
        border-color: var(--primary-black);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .message-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        resize: none;
        font-family: inherit;
        max-height: 120px;
        min-height: 45px;
    }

    .input-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .send-btn {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333333 100%);
        color: var(--primary-white);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .send-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .send-btn:active {
        transform: scale(0.95);
    }

    
    .chat-messages::-webkit-scrollbar {
        width: 8px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: transparent;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--border-gray) 0%, var(--text-gray) 100%);
        border-radius: 10px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, var(--text-gray) 0%, var(--primary-black) 100%);
    }

    
    @media (max-width: 768px) {
        .chat-container {
            padding-top: 90px;
        }

        .chat-wrapper {
            margin: 1rem;
            border-radius: 20px;
        }

        .chat-header {
            padding: 1.5rem;
        }

        .chat-user-details h2 {
            font-size: 1.4rem;
        }

        .chat-avatar {
            width: 60px;
            height: 60px;
        }

        .message-bubble {
            max-width: 85%;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
        }

        .chat-messages {
            padding: 1.5rem;
        }

        .chat-input-area {
            padding: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .chat-wrapper {
            margin: 0.5rem;
            border-radius: 15px;
        }

        .message-bubble {
            max-width: 90%;
            font-size: 0.9rem;
        }

        .back-btn span {
            display: none;
        }

        .input-actions .send-btn {
            width: 45px;
            height: 45px;
        }
    }
</style>

<body>
    
    <x-navbar/>

    
    <div class="chat-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-12">
                    <div class="chat-wrapper">
                        
                        <div class="chat-header">
                            <button class="back-btn" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </button>
                            
                            <div class="chat-user-info">
                                @php
                                    $userName = $store->user->nama ?? 'User';
                                    $avatarUrl = $store->user->avatar 
                                        ? asset('storage/' . $store->user->avatar)
                                        : "https://ui-avatars.com/api/?name=" . urlencode($userName) 
                                          . "&size=70&background=000000&color=ffffff&bold=true&format=png";
                                @endphp
                                <img src="{{ $avatarUrl }}" alt="Profile" class="chat-avatar">
                                <div class="chat-user-details">
                                    <h2>{{ $store->user->nama }}</h2>
                                    <small style="opacity: 0.8;">{{ $store->nama_toko }}</small>
                                </div>
                            </div>
                        </div>

                        
                        <div class="chat-messages" id="chatMessages">
                            @if($roomchat && $roomchat->chats->count() > 0)
                                @php
                                    $currentDate = null;
                                @endphp
                                @foreach($roomchat->chats as $chat)
                                    @php
                                        $messageDate = $chat->created_at->format('Y-m-d');
                                        $isToday = $messageDate === now()->format('Y-m-d');
                                        $isYesterday = $messageDate === now()->subDay()->format('Y-m-d');
                                        
                                        if ($isToday) {
                                            $dateLabel = 'Hari ini';
                                        } elseif ($isYesterday) {
                                            $dateLabel = 'Kemarin';
                                        } else {
                                            $dateLabel = $chat->created_at->format('d M Y');
                                        }
                                    @endphp
                                    
                                    @if($currentDate !== $messageDate)
                                        <div class="message-date">{{ $dateLabel }}</div>
                                        @php $currentDate = $messageDate; @endphp
                                    @endif
                                    
                                    <div class="message-group">
                                        <div class="message-bubble {{ $chat->id_user === auth()->id() ? 'message-sent' : 'message-received' }}">
                                            {{ $chat->massage }}
                                            <div class="message-time">{{ $chat->created_at->format('H:i') }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted py-5">
                                    <i class="fas fa-comments fa-3x mb-3" style="opacity: 0.3;"></i>
                                    <p>Belum ada pesan. Mulai percakapan dengan mengirim pesan!</p>
                                </div>
                            @endif
                        </div>

                        
                        <div class="chat-input-area">
                            <form id="chatForm" method="POST" action="{{ route('chat.send', $store->id) }}">
                                @csrf
                                <div class="input-container">
                                    <textarea 
                                        class="message-input" 
                                        id="messageInput"
                                        name="message"
                                        placeholder="Ketik pesan Anda..."
                                        rows="1"
                                        onkeypress="handleKeyPress(event)"
                                        required
                                    ></textarea>
                                    <div class="input-actions">
                                        <button type="submit" class="send-btn">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // CSRF Token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Auto-scroll to bottom of messages
        function scrollToBottom() {
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Handle form submission
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const messageInput = document.getElementById('messageInput');
            const messageText = messageInput.value.trim();
            
            if (messageText) {
                // Send message via AJAX
                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: messageText
                    })
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server tidak mengembalikan JSON response');
                    }
                    
                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.error || 'Terjadi kesalahan pada server');
                    }
                    
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        // Add message to chat
                        addMessageToChat(messageText, true);
                        messageInput.value = '';
                        messageInput.style.height = 'auto';
                        scrollToBottom();
                        
                        // TODO: Emit to Pusher here
                        // pusher.trigger('chat-room-' + storeId, 'new-message', data.message);
                    } else {
                        throw new Error(data.error || 'Gagal mengirim pesan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal mengirim pesan: ' + error.message);
                });
            }
        });

        // Add message to chat UI
        function addMessageToChat(messageText, isSent = false) {
            const messageGroup = document.createElement('div');
            messageGroup.className = 'message-group';
            
            const messageBubble = document.createElement('div');
            messageBubble.className = `message-bubble ${isSent ? 'message-sent' : 'message-received'}`;
            
            const currentTime = new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            messageBubble.innerHTML = `
                ${messageText}
                <div class="message-time">${currentTime}</div>
            `;
            
            messageGroup.appendChild(messageBubble);
            document.getElementById('chatMessages').appendChild(messageGroup);
        }

        // Handle Enter key press
        function handleKeyPress(event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                document.getElementById('chatForm').dispatchEvent(new Event('submit'));
            }
        }

        // Auto-resize textarea
        document.getElementById('messageInput').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Initial scroll to bottom
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });

        // TODO: Pusher integration
        // const pusher = new Pusher('your-pusher-key', {
        //     cluster: 'your-cluster'
        // });
        
        // const channel = pusher.subscribe('chat-room-{{ $store->id }}');
        // channel.bind('new-message', function(data) {
        //     if (data.user_id !== {{ auth()->id() }}) {
        //         addMessageToChat(data.message, false);
        //         scrollToBottom();
        //     }
        // });
    </script>
</body>

</html>