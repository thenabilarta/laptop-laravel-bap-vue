<template>
  <div>
    <div v-if="modalIsOpen" class="my-modal" @click.self="closeModal">
      <div class="my-modal-content">
        <div class="my-modal-header">
          <p>Change Default Layout</p>
        </div>
        <div class="my-modal-body">
          <p>Default layout</p>
          <sui-dropdown
            placeholder="--"
            selection
            :options="listLayout"
            v-model="current"
          />
        </div>
        <div class="my-modal-actions">
          <sui-button @click="closeModal" color="yellow">Cancel</sui-button>
          <sui-button color="green" @click="changeLayout">OK</sui-button>
        </div>
      </div>
    </div>
    <div class="header">
      <div class="header-filter">
        <sui-input placeholder="Name" />
        <sui-dropdown text="Status" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <sui-dropdown text="Logged in" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <sui-dropdown text="Authorize" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <sui-dropdown text="Group" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <sui-dropdown text="Profile" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <sui-input placeholder="Tags" />
        <sui-dropdown text="Client Type" floating>
          <sui-dropdown-menu>
            <sui-dropdown-item>Image</sui-dropdown-item>
            <sui-dropdown-item>PDF</sui-dropdown-item>
            <sui-dropdown-item>Video</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
      </div>
      <div class="header-icon">
        <sui-dropdown icon="eye" floating multiple>
          <sui-dropdown-menu>
            <sui-dropdown-item>True</sui-dropdown-item>
            <sui-dropdown-item>False</sui-dropdown-item>
            <sui-dropdown-item>True</sui-dropdown-item>
          </sui-dropdown-menu>
        </sui-dropdown>
        <i class="fas fa-print"></i>
      </div>
    </div>
    <div class="body">
      <sui-table selectable celled>
        <sui-table-header>
          <sui-table-row>
            <sui-table-header-cell>ID</sui-table-header-cell>
            <sui-table-header-cell>Display</sui-table-header-cell>
            <sui-table-header-cell>Authorized</sui-table-header-cell>
            <sui-table-header-cell>Logged in</sui-table-header-cell>
            <sui-table-header-cell>Default Layout</sui-table-header-cell>
            <sui-table-header-cell>Last Accessed</sui-table-header-cell>
            <sui-table-header-cell>IP Address</sui-table-header-cell>
            <sui-table-header-cell></sui-table-header-cell>
          </sui-table-row>
        </sui-table-header>
        <sui-table-body>
          <sui-table-row v-for="list in tableList" v-bind:key="list.id">
            <sui-table-cell>{{ list.displayId }}</sui-table-cell>
            <sui-table-cell>{{ list.display }}</sui-table-cell>
            <sui-table-cell>{{ list.licensed === 1 ? "true" : "false" }}</sui-table-cell>
            <sui-table-cell>{{ list.loggedIn === 1 ? "true" : "false" }}</sui-table-cell>
            <sui-table-cell>{{ list.defaultLayout }}</sui-table-cell>
            <sui-table-cell>{{ list.lastAccessed }}</sui-table-cell>
            <sui-table-cell>{{ list.clientAddress }}</sui-table-cell>
            <sui-table-cell>
              <sui-dropdown floating pointing="top right">
                <sui-dropdown-menu>
                  <sui-dropdown-item>Edit</sui-dropdown-item>
                  <sui-dropdown-item>Delete</sui-dropdown-item>
                  <sui-dropdown-divider />
                  <sui-dropdown-item @click="openModal(list.displayId)">Default Layout</sui-dropdown-item>
                </sui-dropdown-menu>
              </sui-dropdown>
            </sui-table-cell>
          </sui-table-row>
        </sui-table-body>
      </sui-table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

import "../css/index.css";

export default {
  data() {
    return {
      tableList: {},
      modalIsOpen: false,
      layoutData: {},
      current: null,
      options: [],
      modalId: null,
    };
  },
  watch: {
    current: function() {
      console.log(this.current);
    },
  },
  computed: {
    listLayout() {
      this.layoutData.forEach((l) => {
        let newData = {
          text: l.layout,
          value: l.layoutId,
        };
        this.options.push(newData);
      });
      return this.options;
    },
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/display/data").then((res) => {
      console.log(res.data);
      this.tableList = res.data;
    });

    axios.get("http://127.0.0.1:8000/display/layout").then((res) => {
      console.log(res.data);
      this.layoutData = res.data;
    });
  },
  methods: {
    openModal(id) {
      this.modalIsOpen = true;
      this.modalId = id;
    },
    closeModal() {
      this.modalIsOpen = false;
    },
    changeLayout() {
      axios
        .post("http://127.0.0.1:8000/display/setlayout", {
          layoutId: this.current,
          displayId: this.modalId,
        })
        .then(() => (this.modalIsOpen = false))
        .then(() =>
          swal("Saved!", "You've changed the Default Layout!", "success")
        )
        .then(() => this.refreshPage());
    },
    refreshPage() {
      axios.get("http://127.0.0.1:8000/display/data").then((res) => {
        console.log(res.data);
        this.tableList = res.data;
      });
    },
  },
};
</script>
