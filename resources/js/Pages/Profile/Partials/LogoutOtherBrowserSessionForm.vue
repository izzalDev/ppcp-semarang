<template>
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-0">Browser Sessions</h5>
            <p class="mb-1 text-secondary">Manage and log out your active sessions on other browsers and devices.</p>
            <p class="mb-3 text-secondary">If necessary, you may log out of all of your other browser sessions across
                all of your devices. Some of your recent sessions are listed below; however, this list may not be
                exhaustive. If you feel your account has been compromised, you should also update your password.</p>
            <div>
                <div class="d-flex justify-content-start">
                    <div>
                        <svg width="36px" height="36px" class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"></path>
                        </svg>
                    </div>
                    <div class="ms-3">
                        <div class="text-sm text-gray-600">OS X - Chrome</div>
                        <div>
                            <div class="text-xs text-gray-500">127.0.0.1, <span class="text-green-500 font-semibold">This device</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="d-flex justify-content-end">
                    <input type="button" class="btn btn-primary px-4" value="Logout Other Browser Sessions">
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
