<template>
  <div class="preview-profile-modal" @click.self="closeModalPreviewProfile">
    <div class="preview-profile-modal-content">
      <div class="preview-profile-modal-header">
        <h1>Preview Profile</h1>
      </div>
      <div class="preview-profile-modal-body">
        <sui-table selectable celled>
          <sui-table-header>
            <sui-table-row>
              <sui-table-header-cell>Setting</sui-table-header-cell>
              <sui-table-header-cell>Value</sui-table-header-cell>
            </sui-table-row>
          </sui-table-header>
          <sui-table-body>
            <sui-table-row>
              <sui-table-cell>Display Id</sui-table-cell>
              <sui-table-cell>{{ dataTableList.displayId }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Auditing Until</sui-table-cell>
              <sui-table-cell>{{ dataTableList.auditingUntil }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Display</sui-table-cell>
              <sui-table-cell>{{ dataTableList.display }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Description</sui-table-cell>
              <sui-table-cell>{{ dataTableList.description }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Default Layout ID</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.defaultLayoutId
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>License</sui-table-cell>
              <sui-table-cell>{{ dataTableList.license }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Licensed</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.licensed === 1 ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Logged In</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.loggedIn === 1 ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Last Accessed</sui-table-cell>
              <sui-table-cell>{{ dataTableList.lastAccessed }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Included Schedule</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.incSchedule === 1 ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Email Alert</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.emailAlert === 1 ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Alert Timeout</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.alertTimeout === 1 ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Client Address</sui-table-cell>
              <sui-table-cell>{{ dataTableList.clientAddress }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Media Inventory Status</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.mediaInventoryStatus
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>MAC Address</sui-table-cell>
              <sui-table-cell>{{ dataTableList.macAddress }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Last Changed</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.lastChanged ? dataTableList.lastChanged : "Never"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Number of Mac Address Changes</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.numberOfMacAddressChanges
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Last Wake on LAN Command Set</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.lastWakeOnLanCommandSent
                  ? dataTableList.lastWakeOnLanCommandSent
                  : "Null"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Wake on LAN Enabled</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.wakeOnLanEnabled
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Wake on LAN Time</sui-table-cell>
              <sui-table-cell>{{ dataTableList.wakeOnLanTime }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Broadcast Address</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.broadCastAddress
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Secure on</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.secureOn ? "true" : "false"
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>CIDR</sui-table-cell>
              <sui-table-cell>{{ dataTableList.cidr }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Latitude</sui-table-cell>
              <sui-table-cell>{{ dataTableList.latitude }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Longitude</sui-table-cell>
              <sui-table-cell>{{ dataTableList.longitude }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Client Type</sui-table-cell>
              <sui-table-cell>{{ dataTableList.clientType }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Client Version</sui-table-cell>
              <sui-table-cell>{{ dataTableList.clientVersion }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Client Code</sui-table-cell>
              <sui-table-cell>{{ dataTableList.clientCode }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Display Profile Id</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.displayProfileId
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Current Layout Id</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.currentLayoutId
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Storage Available Space</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.storageAvailableSpace
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Storage Total Space</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.storageTotalSpace
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Display Group ID</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.displayGroupId
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Current Layout</sui-table-cell>
              <sui-table-cell>{{ dataTableList.currentLayout }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Default Layout</sui-table-cell>
              <sui-table-cell>{{ dataTableList.defaultLayout }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>XMR Channel</sui-table-cell>
              <sui-table-cell>{{ dataTableList.xmrChannel }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>XMR Public Key</sui-table-cell>
              <sui-table-cell></sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Last Command Success</sui-table-cell>
              <sui-table-cell>{{
                dataTableList.lastCommandSuccess
              }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Device Name</sui-table-cell>
              <sui-table-cell>{{ dataTableList.deviceName }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>Time Zone</sui-table-cell>
              <sui-table-cell>{{ dataTableList.timeZone }}</sui-table-cell>
            </sui-table-row>
            <sui-table-row>
              <sui-table-cell>tags</sui-table-cell>
              <sui-table-cell>{{ dataTableList.tags }}</sui-table-cell>
            </sui-table-row>
          </sui-table-body>
        </sui-table>
      </div>
      <div class="preview-profile-modal-actions">
        <sui-button positive content="Close" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import _ from "lodash";

import "../../css/PreviewProfileModal.css";

export default {
  name: "PreviewProfileModal",
  data() {
    return {
      dataTableList: {},
    };
  },
  props: {
    tableList: Array,
    previewProfileModalOpenId: Number,
  },
  mounted() {
    console.log(this.tableList);
    let data = _.filter(this.tableList, (t) => {
      return t.displayId === this.previewProfileModalOpenId;
    });
    this.dataTableList = data[0];
    console.log(this.previewProfileModalOpenId);
  },
  methods: {
    closeModalPreviewProfile() {
      this.$emit("closeModalPreviewProfile");
    },
  },
};
</script>
