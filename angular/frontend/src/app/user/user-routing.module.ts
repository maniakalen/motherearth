import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuardService } from "../auth-guard.service";
import { LoginComponent } from "./login/login.component";
import { DashboardComponent } from "./dashboard/dashboard.component";
import { UserComponent } from "./user/user.component";
import { HeadlessLayoutComponent } from "../headless-layout/headless-layout.component";
import { HeaderLayoutComponent } from '../header-layout/header-layout.component';
import { LogoutComponent } from "./logout/logout.component";
import { SignupComponent } from "./signup/signup.component";


const routes: Routes = [
  {
    path: '',
    component: HeadlessLayoutComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'front' },
      {
        path: 'user',
        component: UserComponent,
        children: [
          { path: 'login', component: LoginComponent },
          { path: 'logout', component: LogoutComponent },
          { path: 'signup', component: SignupComponent },
        ]
      }
    ]
  },
  {
    path: '',
    component: HeaderLayoutComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'front' },
      {
        path: 'user',
        component: UserComponent,
        children: [
          {
            path: 'profile',
            component: DashboardComponent,
            canActivate: [AuthGuardService],
            data: { permission: 'user/profile/view' }
          }
        ]
      }
    ]
  }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UserRoutingModule { }
