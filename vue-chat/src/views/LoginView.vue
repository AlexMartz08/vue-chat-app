<template>
  <div class="flex items-center min-h-screen bg-gray-100">
    <div
      class="rounded-3xl max-w-sm md:max-w-md lg:max-w-xl w-full m-auto shadow-lg shadow-emerald-300/50 py-12 px-4 bg-white sm:px-6 lg:px-8"
    >
      <div class="space-y-8">
        <div>
          <div class="flex justify-center items-center space-x-2 mb-10">
            <img
              class="h-20 w-20 object-cover rounded-full"
              src="@/assets/iconVue.png"
              alt=""
            />
            <h1 class="text-4xl italic font-extralight">My Vue Chat</h1>
          </div>
          <h2 class="mt-6 text-center text-2xl font-extralight text-gray-900">
            Sign in to your account
          </h2>
          <!-- <p class="mt-2 text-center text-sm text-gray-600"> -->
          <router-link
            class="text-center block mt-2 font-medium text-emerald-600 hover:text-emerald-500"
            to="/register"
            >or create an account?</router-link
          >
          <!-- </p> -->
        </div>

        <!-- form  :validation-schema="schema"-->
        <Form class="mt-8" @submit="handleSubmit" :validation-schema="schema">
          <div class="rounded-md shadow-sm">
            <div class="h-16">
              <label for="email-address" class="sr-only">Email address</label>
              <Field
                id="email-address"
                name="email"
                type="email"
                autocomplete="email"
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Email address"
              />
              <ErrorMessage name="email" class="text-red-500" />
            </div>

            <div class="h-16 mb-4">
              <label for="password" class="sr-only">Password</label>
              <Field
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Password"
              />
              <ErrorMessage name="password" class="text-red-500" />
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
            >
              Sign in
            </button>
          </div>
        </Form>
      </div>
    </div>
  </div>
</template>

<script setup>
import ky from "ky";
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import router from "../router";
import buildVeeFormErrors from "../utilities/buildVeeFormErrors.js";

const schema = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required(),
});

async function handleSubmit(values, { setErrors, resetForm }) {
  try {
    const resp = await ky
      .post("http://localhost:8000/api/login", {
        json: values,
      })
      .json();

    localStorage.setItem("access_token", resp.access_token);
    router.push("/");
    resetForm();
  } catch (error) {
    const resp = await error.response.json();

    const errors = buildVeeFormErrors(resp.errors);
    setErrors(errors);
    localStorage.removeItem("access_token");
  }
}
</script>
