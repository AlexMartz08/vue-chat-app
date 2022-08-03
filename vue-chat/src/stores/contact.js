import { defineStore } from "pinia";
import ky from "ky";

export const useContactStore = defineStore("contact", {
  state: () => ({ contacts: [], contactSelect: {} }),
  actions: {
    async getContacts() {
      const access_token = localStorage.getItem("access_token");

      const { data } = await ky
        .get(`${import.meta.env.VITE_API_URL}/users`, {
          headers: {
            Authorization: `Bearer ${access_token}`,
          },
        })
        .json();
      this.contacts = data;
    },

    getContactId(contact) {
      this.contactSelect = contact;
    },
  },
});
