import axios from 'axios';
import { RequestError } from './RequestErrors';

const HTTP = axios.create({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Accept': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  }
});

const validateValidStatus = (response) => {

  return response;
};

//ToDo Realizar traduções
const handleDefaultErrors = (error) => {
  if (error.response == undefined) {
    throw new RequestError('Falha na comunicação com o servidor');
  }

  if (error.response.status === 401) {
    throw new RequestError('Não autenticado');
  }

  if (error.response.status === 500) {
    throw new RequestError('Erro na comunicação com o servidor');
  }

  throw new RequestError(error.response.data.message);
};

const defineDefaultInterceptors = (HTTP) => {
  HTTP.interceptors.response.use((success) => validateValidStatus(success), handleDefaultErrors);
};

defineDefaultInterceptors(HTTP);

export {
  HTTP
};
