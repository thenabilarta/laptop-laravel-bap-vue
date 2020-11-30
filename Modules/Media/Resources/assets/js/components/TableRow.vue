<template>
  <sui-table-body>
    <sui-table-row v-if="list">
      <sui-table-cell>{{ list.media_id }}</sui-table-cell>
      <sui-table-cell v-if="nameTableColumn">{{ list.name }}</sui-table-cell>
      <sui-table-cell class="td-table-image">
        <img
          class="table-image"
          :src="`/storage/uploads/${list.file_name}`"
          alt=""
        />
      </sui-table-cell>
      <sui-table-cell>{{ list.duration }}</sui-table-cell>
      <sui-table-cell>{{ list.size }}</sui-table-cell>
      <sui-table-cell>Admin</sui-table-cell>
      <sui-table-cell>Null</sui-table-cell>
      <sui-table-cell>{{ list.file_name }}</sui-table-cell>
      <sui-table-cell>
        <sui-dropdown floating>
          <sui-dropdown-menu>
            <sui-dropdown-item @click="toEdit">Edit</sui-dropdown-item>
            <sui-dropdown-item @click="toDelete">Delete</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
      </sui-table-cell>
      <EditTableRow
        v-on:closeModal="onCloseModal"
        v-if="isEditing"
        v-bind:list="list"
        v-on:updateEdit="refreshTable"
      ></EditTableRow>
    </sui-table-row>
  </sui-table-body>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

import EditTableRow from "./EditTableRow";
import "../../css/table-row.css";

export default {
  components: {
    EditTableRow: EditTableRow,
  },
  watch: {
    list: function() {
      console.log("Changed");
    },
  },
  name: "TableRow",
  props: {
    list: Object,
    index: Number,
    nameTableColumn: Boolean,
  },
  data() {
    return {
      isEditing: false,
    };
  },
  methods: {
    toDelete() {
      console.log(this.list.media_id);
      swal("Do you want to delete this media?", {
        buttons: {
          Cancel: true,
          Delete: {
            value: "delete",
          },
        },
      }).then((value) => {
        switch (value) {
          case "delete":
            axios
              .get("http://127.0.0.1:8000/media/delete/" + this.list.media_id)
              .then((res) => console.log(res))
              .then(() => this.refreshTable());
            break;
          default:
            console.log("Cancelled");
        }
      });
    },
    toEdit() {
      this.isEditing = true;
    },
    onCloseModal() {
      this.isEditing = false;
    },
    refreshTable() {
      this.$emit("refreshTable");
      this.isEditing = false;
    },
  },
};
</script>
