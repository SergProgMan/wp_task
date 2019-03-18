/* eslint-env browser */
/* globals beetrootstarterDIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (beetrootstarterDIST_PATH) {
  __webpack_public_path__ = beetrootstarterDIST_PATH; // eslint-disable-line no-undef, camelcase
}
