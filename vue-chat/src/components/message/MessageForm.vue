<template>
  <Form
    @submit="handleSubmit"
    :validation-schema="schema"
    class="border flex items-center mb-8 w-full max-w-3xl mx-auto rounded-full bg-white"
  >
    <button class="rounded-full mx-9 w-7 h-7 text-gray-400">
      <font-awesome-icon :icon="['far', 'face-smile']" size="2x" />
    </button>
    <div class="w-0.5 h-8 mr-9 bg-gray-300"></div>

    <Field
      class="flex-1 border-none rounded focus:border-emerald-500 focus:ring-emerald-500"
      placeholder="Type Your Message Here . . . "
      type="text"
      name="text"
    />
    <button
      class="mx-3 my-2 border rounded-full w-16 h-16 bg-emerald-700 hover:bg-emerald-600"
      type="submit"
    >
      <font-awesome-icon icon="paper-plane" size="lg" color="white" />
    </button>
  </Form>
</template>

<script setup>
import ky from "ky";
import { Field, Form } from "vee-validate";
import * as yup from "yup";
import { useContactStore } from "../../stores/contact";

const schema = yup.object({
  text: yup.string().required(),
});

const contactState = useContactStore();
// const id = contactState.contactSelect.id;

const access_token = localStorage.getItem("access_token");

async function handleSubmit(values, { resetForm }) {
  console.log("submit");
  await ky
    .post(
      `http://localhost:8000/api/messages/user/${contactState.contactSelect.id}`,
      {
        headers: {
          Authorization: `Bearer ${access_token}`,
        },
        json: values,
      }
    )
    .json();
  resetForm();
}
</script>
