import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PageNotFoundComponent } from "./page-not-found/page-not-found.component";
import { UserModule } from "./user/user.module";
import { MapComponent } from "./map/map.component";
import { HeaderLayoutComponent } from "./header-layout/header-layout.component";
import { FrontComponent } from "./front/front.component";
import { HeadlessLayoutComponent } from "./headless-layout/headless-layout.component";


const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: '/front' },
  {
    path: '',
    component: HeadlessLayoutComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: '/front' },
      { path: 'front', component: FrontComponent }
    ]
  },
  {
    path: '',
    component: HeaderLayoutComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'front' },
      { path:'map', component: MapComponent }
    ]
  },
  { path: '**', component: PageNotFoundComponent }
];

@NgModule({
  imports: [UserModule, RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
