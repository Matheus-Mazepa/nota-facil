import { HTTP } from './http_service';

export const login = function(email, password) {
  return HTTP.post('/api/auth/login', {
    email: email, password: password
  }).then((response) => {
    commit('accessToken/SET_EXPIRES_AT', response.data.expires_at);
    return response.data;
  });
};

export default {
  login,
}
