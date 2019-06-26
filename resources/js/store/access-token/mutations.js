export default {
  SET_ACCESS_TOKEN(state, accessToken) {
    state.accessToken = accessToken;
  },

  SET_EXPIRES_AT(state, expiresAt) {
    state.expiresAt = expiresAt;
  },
}
