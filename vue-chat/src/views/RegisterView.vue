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
            <h1 class="text-4xl italic font-light">My Vue Chat</h1>
          </div>
          <h2 class="mt-6 text-center text-3xl font-extralight text-gray-900">
            Create your account
          </h2>
          <router-link
            class="block mt-2 text-center font-medium text-emerald-600 hover:text-emerald-500"
            to="/login"
            >or already register?</router-link
          >
        </div>

        <Form class="mt-8" @submit="handleSubmit" :validation-schema="schema">
          <div class="rounded-md shadow-sm">
            <div class="h-16">
              <label for="name" class="sr-only">Name</label>
              <Field
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Your Name"
              />
              <ErrorMessage name="name" class="text-red-500" />
            </div>
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
        <!-- <form class="mt-8 space-y-6" action="#" method="POST">
          <input type="hidden" name="remember" value="true" />
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="name" class="sr-only">User Name</label>
              <input
                id="name"
                name="name"
                type="name"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Your name"
              />
            </div>

            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input
                id="email-address"
                name="email"
                type="email"
                autocomplete="email"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Email address"
              />
            </div>

            <div>
              <label for="password" class="sr-only">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm"
                placeholder="Password"
              />
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
            >
              Create Account
            </button>
          </div>
        </form> -->
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
  name: yup.string().required(),
  email: yup.string().required().email(),
  password: yup.string().required().min(8),
});

async function handleSubmit(values, { setErrors, resetForm }) {
  try {
    const resp = await ky
      .post("http://localhost:8000/api/register", {
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
  }
}
</script>
