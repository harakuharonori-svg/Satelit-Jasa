@extends('layout.main')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <button onclick="history.back()" class="p-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        Review Proyek
                    </h1>
                    <p class="text-gray-600 mt-2">Tinjau hasil pekerjaan yang dikirim freelancer</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Informasi Proyek</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2" id="projectTitle">Loading...</h3>
                        <p class="text-gray-600 mb-4" id="projectDescription">Loading...</p>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Freelancer:</span>
                                <span class="font-medium" id="freelancerName">Loading...</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Harga:</span>
                                <span class="font-bold text-green-600 text-lg" id="projectPrice">Loading...</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-2 py-1 text-xs rounded-full" id="projectStatus">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-800 mb-2">Timeline</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibuat:</span>
                                <span id="createdAt">Loading...</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dibayar:</span>
                                <span id="paidAt">Loading...</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dikirim:</span>
                                <span id="deliveredAt">Loading...</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Auto Release:</span>
                                <span class="text-orange-600 font-medium" id="autoReleaseDate">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Detail Pengiriman</h2>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <h4 class="font-medium text-gray-800 mb-3">Pesan dari Freelancer</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700" id="deliveryMessage">Loading...</p>
                    </div>
                    <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                        <span>Dikirim: <span id="deliveredTime">Loading...</span></span>
                        <span>Tipe: <span id="deliveryType">Loading...</span></span>
                    </div>
                </div>
                <div id="deliveryFiles" class="mb-6">
                </div>
                <div id="revisionHistory" class="mb-6" style="display: none;">
                    <h4 class="font-medium text-gray-800 mb-3">Riwayat Revisi</h4>
                    <div id="revisionList">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Aksi</h2>
                <p class="text-sm text-gray-600">Pilih tindakan untuk proyek ini</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-green-200 rounded-lg p-6 bg-green-50">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-green-800 ml-4">Setujui Proyek</h3>
                        </div>
                        <p class="text-green-700 mb-4">Proyek sesuai dengan ekspektasi. Pembayaran akan dirilis ke freelancer.</p>
                        <button onclick="openApprovalModal()" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">
                            Setujui & Rilis Pembayaran
                        </button>
                    </div>
                    <div class="border border-orange-200 rounded-lg p-6 bg-orange-50">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-orange-800 ml-4">Minta Revisi</h3>
                        </div>
                        <p class="text-orange-700 mb-4">Proyek perlu perbaikan atau penyesuaian. Berikan feedback untuk revisi.</p>
                        <button onclick="openRevisionModal()" class="w-full px-4 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium">
                            Minta Revisi
                        </button>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-blue-800">Penting!</h4>
                            <p class="text-blue-700 text-sm mt-1">
                                Jika tidak ada aksi dalam <span class="font-semibold" id="autoReleaseCountdown">7 hari</span>, 
                                pembayaran akan otomatis dirilis ke freelancer. Pastikan untuk memberikan feedback sebelum batas waktu.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-xl max-w-lg w-full">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-800">Setujui Proyek</h3>
                        <button onclick="closeApprovalModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="approvalForm" class="p-6">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating untuk Freelancer</label>
                                <div class="flex space-x-1" id="ratingStars">
                                    <button type="button" onclick="setRating(1)" class="text-gray-300 hover:text-yellow-400 text-2xl">★</button>
                                    <button type="button" onclick="setRating(2)" class="text-gray-300 hover:text-yellow-400 text-2xl">★</button>
                                    <button type="button" onclick="setRating(3)" class="text-gray-300 hover:text-yellow-400 text-2xl">★</button>
                                    <button type="button" onclick="setRating(4)" class="text-gray-300 hover:text-yellow-400 text-2xl">★</button>
                                    <button type="button" onclick="setRating(5)" class="text-gray-300 hover:text-yellow-400 text-2xl">★</button>
                                </div>
                                <input type="hidden" id="customerRating" name="customer_rating" value="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Feedback (Opsional)</label>
                                <textarea name="customer_feedback" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Berikan feedback untuk freelancer..."></textarea>
                            </div>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="font-medium text-green-800 mb-2">Konfirmasi Persetujuan</h4>
                                <p class="text-green-700 text-sm">
                                    Dengan menyetujui proyek ini, pembayaran sebesar <span class="font-semibold" id="releaseAmount">Rp 0</span> 
                                    akan segera dirilis ke freelancer dan tidak dapat dibatalkan.
                                </p>
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" onclick="closeApprovalModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    Setujui Proyek
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="revisionModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-xl max-w-lg w-full">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-gray-800">Minta Revisi</h3>
                        <button onclick="closeRevisionModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="revisionForm" class="p-6">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Revisi</label>
                                <textarea name="revision_notes" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Jelaskan secara detail bagian mana yang perlu diperbaiki atau diubah..." required></textarea>
                                <div class="text-right text-sm text-gray-500 mt-1">
                                    <span id="revisionCount">0</span>/500 karakter
                                </div>
                            </div>
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                <h4 class="font-medium text-orange-800 mb-2">Tips untuk Permintaan Revisi</h4>
                                <ul class="text-orange-700 text-sm space-y-1">
                                    <li>• Berikan feedback yang spesifik dan konstruktif</li>
                                    <li>• Jelaskan dengan detail bagian yang perlu diperbaiki</li>
                                    <li>• Sertakan contoh atau referensi jika diperlukan</li>
                                    <li>• Hindari permintaan yang di luar scope awal</li>
                                </ul>
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" onclick="closeRevisionModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit" class="flex-1 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                                    Kirim Permintaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let currentTransaksi = null;
let currentDelivery = null;
let selectedRating = 0;
const urlParams = new URLSearchParams(window.location.search);
const transaksiId = urlParams.get('transaksi_id');
const deliveryId = urlParams.get('delivery_id');
document.addEventListener('DOMContentLoaded', function() {
    if (!transaksiId || !deliveryId) {
        showNotification('Parameter tidak lengkap', 'error');
        return;
    }
    loadProjectData();
});
async function loadProjectData() {
    try {
        showNotification('Memuat data proyek...', 'info');
        const response = await fetch(`/escrow/project-review-data?transaksi_id=${transaksiId}&delivery_id=${deliveryId}`);
        const result = await response.json();
        if (result.success) {
            currentTransaksi = result.data.transaksi;
            currentDelivery = result.data.delivery;
            updateProjectInfo();
            updateDeliveryDetails();
            updateActionButtons();
            if (result.data.revision_history.length > 0) {
                updateRevisionHistory(result.data.revision_history);
            }
        } else {
            showNotification('Error: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Error loading project data:', error);
        showNotification('Gagal memuat data proyek', 'error');
        loadSampleData();
    }
}
function loadSampleData() {
    currentTransaksi = {
        id: transaksiId,
        jasa: {
            nama_jasa: 'Desain Logo Perusahaan',
            deskripsi: 'Pembuatan logo modern untuk perusahaan teknologi'
        },
        store: {
            nama_toko: 'Design Studio Pro',
            user: {
                name: 'Ahmad Freelancer'
            }
        },
        total: 500000,
        project_status: 'delivered',
        escrow_status: 'held',
        created_at: '2024-01-15T10:00:00Z',
        paid_at: '2024-01-15T12:00:00Z',
        delivered_at: '2024-01-20T15:30:00Z',
        auto_release_days: 7
    };
    currentDelivery = {
        id: deliveryId,
        delivery_message: 'Logo sudah selesai dibuat sesuai dengan brief yang diberikan. Saya telah membuat 3 variasi desain dengan format vector (AI, EPS) dan raster (PNG, JPG) dengan resolusi tinggi. File-file sudah siap untuk digunakan di berbagai media.',
        delivery_type: 'mixed',
        delivery_files: [
            {
                name: 'Logo_Final_Vector.ai',
                path: 'deliveries/logo_vector.ai',
                size: 2048000,
                type: 'application/illustrator'
            },
            {
                name: 'Logo_Variants_PNG.zip',
                path: 'deliveries/logo_variants.zip',
                size: 5120000,
                type: 'application/zip'
            },
            {
                name: 'Brand_Guidelines.pdf',
                path: 'deliveries/brand_guidelines.pdf',
                size: 1024000,
                type: 'application/pdf'
            }
        ],
        delivered_at: '2024-01-20T15:30:00Z',
        status: 'delivered'
    };
    updateProjectInfo();
    updateDeliveryDetails();
    updateActionButtons();
}
function updateProjectInfo() {
    document.getElementById('projectTitle').textContent = currentTransaksi.jasa.nama_jasa;
    document.getElementById('projectDescription').textContent = currentTransaksi.jasa.deskripsi;
    document.getElementById('freelancerName').textContent = currentTransaksi.store.user.name;
    document.getElementById('projectPrice').textContent = 'Rp ' + numberFormat(currentTransaksi.total);
    const statusElement = document.getElementById('projectStatus');
    statusElement.textContent = currentTransaksi.project_status;
    statusElement.className = 'px-2 py-1 text-xs rounded-full ' + getProjectStatusColor(currentTransaksi.project_status);
    document.getElementById('createdAt').textContent = formatDate(currentTransaksi.created_at);
    document.getElementById('paidAt').textContent = formatDate(currentTransaksi.paid_at);
    document.getElementById('deliveredAt').textContent = formatDate(currentTransaksi.delivered_at);
    const autoReleaseDate = new Date(currentTransaksi.delivered_at);
    autoReleaseDate.setDate(autoReleaseDate.getDate() + currentTransaksi.auto_release_days);
    document.getElementById('autoReleaseDate').textContent = formatDate(autoReleaseDate.toISOString());
    const now = new Date();
    const daysLeft = Math.ceil((autoReleaseDate - now) / (1000 * 60 * 60 * 24));
    document.getElementById('autoReleaseCountdown').textContent = daysLeft > 0 ? daysLeft + ' hari' : 'Segera';
    const freelancerEarnings = currentTransaksi.total * 0.95; // Assuming 5% platform fee
    document.getElementById('releaseAmount').textContent = 'Rp ' + numberFormat(freelancerEarnings);
}
function updateDeliveryDetails() {
    document.getElementById('deliveryMessage').textContent = currentDelivery.delivery_message;
    document.getElementById('deliveredTime').textContent = formatDate(currentDelivery.delivered_at);
    document.getElementById('deliveryType').textContent = getDeliveryTypeText(currentDelivery.delivery_type);
    const filesContainer = document.getElementById('deliveryFiles');
    if (currentDelivery.delivery_files && currentDelivery.delivery_files.length > 0) {
        let filesHtml = '<h4 class="font-medium text-gray-800 mb-3">File yang Dikirim</h4><div class="space-y-3">';
        currentDelivery.delivery_files.forEach(file => {
            filesHtml += `
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            ${getFileIcon(file.type)}
                        </div>
                        <div>
                            <h5 class="font-medium text-gray-800">${file.name}</h5>
                            <p class="text-sm text-gray-500">${formatFileSize(file.size)}</p>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="previewFile('${file.path}')" class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                            Preview
                        </button>
                        <button onclick="downloadFile('${file.path}', '${file.name}')" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition-colors">
                            Download
                        </button>
                    </div>
                </div>
            `;
        });
        filesHtml += '</div>';
        filesContainer.innerHTML = filesHtml;
    } else {
        filesContainer.innerHTML = '<p class="text-gray-500 text-sm">Tidak ada file yang dikirim</p>';
    }
}
function updateActionButtons() {
    if (currentDelivery.status !== 'delivered') {
        document.querySelector('button[onclick="openApprovalModal()"]').disabled = true;
        document.querySelector('button[onclick="openRevisionModal()"]').disabled = true;
    }
}
function openApprovalModal() {
    document.getElementById('approvalModal').classList.remove('hidden');
    resetRating();
}
function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
    resetRating();
}
function openRevisionModal() {
    document.getElementById('revisionModal').classList.remove('hidden');
}
function closeRevisionModal() {
    document.getElementById('revisionModal').classList.add('hidden');
}
function setRating(rating) {
    selectedRating = rating;
    document.getElementById('customerRating').value = rating;
    const stars = document.querySelectorAll('#ratingStars button');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.className = 'text-yellow-400 text-2xl';
        } else {
            star.className = 'text-gray-300 hover:text-yellow-400 text-2xl';
        }
    });
}
function resetRating() {
    selectedRating = 0;
    document.getElementById('customerRating').value = '';
    const stars = document.querySelectorAll('#ratingStars button');
    stars.forEach(star => {
        star.className = 'text-gray-300 hover:text-yellow-400 text-2xl';
    });
}
document.querySelector('textarea[name="revision_notes"]').addEventListener('input', function(e) {
    const count = e.target.value.length;
    document.getElementById('revisionCount').textContent = count;
    if (count > 500) {
        e.target.value = e.target.value.substring(0, 500);
        document.getElementById('revisionCount').textContent = 500;
    }
});
document.getElementById('approvalForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('transaksi_id', transaksiId);
    formData.append('delivery_id', deliveryId);
    try {
        const response = await fetch('/escrow/approve', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const result = await response.json();
        if (result.success) {
            showNotification('Proyek berhasil disetujui! Pembayaran telah dirilis ke freelancer.', 'success');
            closeApprovalModal();
            setTimeout(() => {
                window.location.href = '/chat';
            }, 2000);
        } else {
            showNotification('Error: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Error approving project:', error);
        showNotification('Gagal menyetujui proyek', 'error');
    }
});
document.getElementById('revisionForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append('transaksi_id', transaksiId);
    formData.append('delivery_id', deliveryId);
    try {
        const response = await fetch('/escrow/revision', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const result = await response.json();
        if (result.success) {
            showNotification('Permintaan revisi berhasil dikirim ke freelancer.', 'success');
            closeRevisionModal();
            setTimeout(() => {
                window.location.href = '/chat';
            }, 2000);
        } else {
            showNotification('Error: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Error requesting revision:', error);
        showNotification('Gagal mengirim permintaan revisi', 'error');
    }
});
function updateRevisionHistory(revisions) {
    const revisionContainer = document.getElementById('revisionHistory');
    const revisionList = document.getElementById('revisionList');
    if (revisions.length > 0) {
        let revisionsHtml = '';
        revisions.forEach((revision, index) => {
            const statusColor = getDeliveryStatusColor(revision.status);
            revisionsHtml += `
                <div class="border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h5 class="font-medium text-gray-800">Revisi #${revisions.length - index}</h5>
                            <p class="text-sm text-gray-600">${formatDate(revision.delivered_at)}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full ${statusColor}">${revision.status}</span>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <h6 class="text-sm font-medium text-gray-700">Pesan Pengiriman:</h6>
                            <p class="text-sm text-gray-600 bg-gray-50 rounded p-2 mt-1">${revision.delivery_message}</p>
                        </div>
                        ${revision.revision_notes ? `
                            <div>
                                <h6 class="text-sm font-medium text-gray-700">Catatan Revisi:</h6>
                                <p class="text-sm text-orange-600 bg-orange-50 rounded p-2 mt-1">${revision.revision_notes}</p>
                            </div>
                        ` : ''}
                        ${revision.customer_feedback ? `
                            <div>
                                <h6 class="text-sm font-medium text-gray-700">Feedback Customer:</h6>
                                <p class="text-sm text-green-600 bg-green-50 rounded p-2 mt-1">${revision.customer_feedback}</p>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        });
        revisionList.innerHTML = revisionsHtml;
        revisionContainer.style.display = 'block';
    } else {
        revisionContainer.style.display = 'none';
    }
}
    window.open('/storage/' + filePath, '_blank');
}
function downloadFile(filePath, fileName) {
    const link = document.createElement('a');
    link.href = '/storage/' + filePath;
    link.download = fileName;
    link.click();
}
function numberFormat(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
function getProjectStatusColor(status) {
    const colors = {
        'paid': 'bg-blue-100 text-blue-800',
        'in_progress': 'bg-purple-100 text-purple-800',
        'delivered': 'bg-orange-100 text-orange-800',
        'completed': 'bg-green-100 text-green-800',
        'cancelled': 'bg-red-100 text-red-800'
    };
    return colors[status] || 'bg-gray-100 text-gray-800';
}
function getDeliveryTypeText(type) {
    const types = {
        'file': 'Upload File',
        'link': 'Link/URL',
        'text': 'Deskripsi Teks',
        'mixed': 'Campuran'
    };
    return types[type] || type;
}
function getFileIcon(mimeType) {
    if (mimeType.includes('image')) {
        return '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>';
    } else if (mimeType.includes('pdf')) {
        return '<svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>';
    } else if (mimeType.includes('zip') || mimeType.includes('rar')) {
        return '<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>';
    } else {
        return '<svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
    }
}
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg max-w-sm ${
        type === 'success' ? 'bg-green-500 text-white' :
        type === 'error' ? 'bg-red-500 text-white' :
        'bg-blue-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center justify-between">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    document.body.appendChild(notification);
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}
</script>
@endsection
