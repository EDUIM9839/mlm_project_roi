<div class="d-flex align-items-center justify-content-center bg-light">
    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-4">
                <h5 class="text-dark fw-bold mb-3">Send OTP</h5>

                <form method="POST" action="{{ route('admin.enter-withdrawal.verify-otp') }}">
                    @csrf
                     <div class="col-md-12 mt-2 d-none" id="otpInput">
                       <label for="inputLastName1" class="form-label"> Enter OTP : </label>
                        <div class="input-group"> <span class="input-group-text bg-transparent">***</span>
                            <input type="text" class="form-control border-start-0" name="otp" id="otp" placeholder="Enter OTP" />
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="button" class="btn btn-dark btn-lg" id="getOTPBtn">Send OTP</button>
                        <button type="submit" class="btn btn-dark btn-lg d-none" id="updateBtn">Verify OTP</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">An OTP will be sent to your admin email address.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   
document.addEventListener('DOMContentLoaded', () => {
    const otpBtn = document.getElementById('getOTPBtn');
    const updateBtn = document.getElementById('updateBtn');
    const otpInput = document.getElementById('otpInput');

    otpBtn?.addEventListener('click', () => sendOTP());

    function toggleVisibility(isSuccess) {
        otpBtn.classList.toggle('d-none', isSuccess);
        otpInput.classList.toggle('d-none', !isSuccess);
        updateBtn.classList.toggle('d-none', !isSuccess);
    }

    async function sendOTP() {
        otpBtn.disabled = true;
        let prevText = otpBtn.innerHTML;
        otpBtn.innerHTML = "&nbsp;&nbsp;Sending...&nbsp;&nbsp;";

        try {
            const response = await fetch(`{{ route('admin.enter-withdrawal.send-otp') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            const data = await response.json();
            toggleVisibility(data.status === 'success');
        } catch (error) {
            console.error('OTP sending failed:', error);
            toggleVisibility(false);
        } finally {
            otpBtn.disabled = false;
            otpBtn.innerHTML = prevText;
        }
    }
});
</script>

