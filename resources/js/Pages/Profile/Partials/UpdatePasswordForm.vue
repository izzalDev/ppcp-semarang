<template>
    <div class="card">
        <div class="card-body p-4">
            <div v-if="$page.props.session.success"
                 class="alert alert-success border-0 bg-success alert-dismissible fade show">
                <div class="text-white">{{ $page.props.session.success }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <h5 class="mb-0">Update Password</h5>
            <p class="mb-3 text-secondary">Ensure your account is using a long, random password to stay secure.</p>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Current Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <div class="input-group has-validation">
                        <input v-model="form.current_password" :type="isPasswordHide?'password':'text'" class="form-control"
                               :class="{'is-invalid':form.errors.current_password}" placeholder="Enter Password">
                        <span class="input-group-text" @click="handleTogglePassword"><i
                            :class="isPasswordHide?'bx bx-hide':'bx bx-show'"></i></span>
                        <div class="invalid-feedback">
                            {{ form.errors.current_password }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">New Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.password" type="password" class="form-control"
                           :class="{'is-invalid':form.errors.password}" placeholder="New Password">
                    <div class="invalid-feedback">{{ form.errors.password }}</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Confirm Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input v-model="form.password_confirmation" type="password" class="form-control"
                           :class="{'is-invalid':form.errors.password_confirmation}"
                           placeholder="Confirm Password">
                    <div class="invalid-feedback">{{ form.errors.password_confirmation }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="d-flex justify-content-end">
                    <input @click="submit" type="button" class="btn btn-primary px-4" value="Save">
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const isPasswordHide = ref(true)

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const handleTogglePassword = function () {
    isPasswordHide.value = !isPasswordHide.value;
}

const submit = () => {
    form.put(route('profile-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>
