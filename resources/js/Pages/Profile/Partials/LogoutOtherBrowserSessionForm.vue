<template>
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-0">Browser Sessions</h5>
            <p class="mb-1 text-secondary">Manage and log out your active sessions on other browsers and devices.</p>
            <p class="mb-3 text-secondary">If necessary, you may log out of all of your other browser sessions across
                all of your devices. Some of your recent sessions are listed below; however, this list may not be
                exhaustive. If you feel your account has been compromised, you should also update your password.</p>
            <div class="row mb-3" v-for="(session,i) in sessions">
                <div class="d-flex justify-content-start">
                    <div>
                        <svg v-if="session.agent.is_desktop" width="36px" height="36px" class="w-8 h-8 text-gray-500"
                             xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"></path>
                        </svg>
                        <svg v-else class="w-8 h-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                        </svg>
                    </div>
                    <div class="ms-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform ? session.agent.platform : 'Unknown' }} -
                            {{ session.agent.browser ? session.agent.browser : 'Unknown' }}
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">127.0.0.1,
                                <span v-if="session.is_current_device" class="text-success">This device</span>
                                <span v-else class="text-green-500 font-semibold">Last Active {{
                                        session.last_active
                                    }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal"
                            data-bs-target="#password-confirm">Logout Other Browser Sessions
                    </button>
                    <!--    modal   -->
                    <div class="modal fade" id="password-confirm" tabindex="-1" aria-hidden="true"
                         style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Logout Other Browser Sessions</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Please enter your password to confirm you would like to log out
                                        of your other browser sessions across all of your devices.</p>
                                    <div class="input-group has-validation">
                                        <input v-model="form.password" :type="isPasswordHide?'password':'text'"
                                               class="form-control"
                                               :class="{'is-invalid':form.errors.password}"
                                               placeholder="Enter Password">
                                        <span class="input-group-text"><i
                                            :class="isPasswordHide?'bx bx-hide':'bx bx-show'"
                                            @click="handleTogglePassword"></i></span>
                                        <div class="invalid-feedback">
                                            {{ form.errors.password }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="handleCancel">Cancel
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="logoutOtherBrowserSessions">Logout Other Browser Sessions</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import {Modal} from "bootstrap";

defineProps({sessions: Array});
let modal = {};
onMounted(()=>{
    modal = new Modal(document.getElementById('password-confirm'));
})

const isPasswordHide = ref(true);

const form = useForm({
    password: ''
})

const handleCancel = ()=>form.reset()

const logoutOtherBrowserSessions = () => {
    form.delete(route('logout-other-browser'), {
        preserveScroll: true,
        onSuccess: () => {
            modal.hide();
        },
        onFinish: () => {
            form.reset();
        },
    });
};

const handleTogglePassword = function () {
    isPasswordHide.value = !isPasswordHide.value;
}
</script>
