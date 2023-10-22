import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';
import { CoursService } from './services/cours.service';

export const authGuard: CanActivateFn = (route, state) => {
  const router=inject(Router);
  const service=inject(CoursService);
  if(service.isToken() ){
    return true;
  }
  else {
    router.navigate(['/'])
    return false;

  }
};
