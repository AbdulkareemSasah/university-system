const Ziggy = {"url":"http:\/\/localhost:8000","port":8000,"defaults":{},"routes":{"filament.exports.download":{"uri":"filament\/exports\/{export}\/download","methods":["GET","HEAD"],"parameters":["export"],"bindings":{"export":"id"}},"filament.imports.failed-rows.download":{"uri":"filament\/imports\/{import}\/failed-rows\/download","methods":["GET","HEAD"],"parameters":["import"],"bindings":{"import":"id"}},"filament.dashboard.auth.login":{"uri":"dashboard\/login","methods":["GET","HEAD"]},"filament.dashboard.auth.logout":{"uri":"dashboard\/logout","methods":["POST"]},"filament.dashboard.pages.dashboard":{"uri":"dashboard","methods":["GET","HEAD"]},"filament.dashboard.resources.classrooms.index":{"uri":"dashboard\/classrooms","methods":["GET","HEAD"]},"filament.dashboard.resources.classrooms.create":{"uri":"dashboard\/classrooms\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.classrooms.view":{"uri":"dashboard\/classrooms\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.classrooms.edit":{"uri":"dashboard\/classrooms\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.collages.index":{"uri":"dashboard\/collages","methods":["GET","HEAD"]},"filament.dashboard.resources.collages.create":{"uri":"dashboard\/collages\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.collages.view":{"uri":"dashboard\/collages\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.collages.edit":{"uri":"dashboard\/collages\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.departments.index":{"uri":"dashboard\/departments","methods":["GET","HEAD"]},"filament.dashboard.resources.departments.create":{"uri":"dashboard\/departments\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.departments.view":{"uri":"dashboard\/departments\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.departments.edit":{"uri":"dashboard\/departments\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.doctors.index":{"uri":"dashboard\/doctors","methods":["GET","HEAD"]},"filament.dashboard.resources.doctors.create":{"uri":"dashboard\/doctors\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.doctors.view":{"uri":"dashboard\/doctors\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.doctors.edit":{"uri":"dashboard\/doctors\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.generals.index":{"uri":"dashboard\/generals","methods":["GET","HEAD"]},"filament.dashboard.resources.generals.view":{"uri":"dashboard\/generals\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.generals.edit":{"uri":"dashboard\/generals\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.levels.index":{"uri":"dashboard\/levels","methods":["GET","HEAD"]},"filament.dashboard.resources.levels.create":{"uri":"dashboard\/levels\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.levels.view":{"uri":"dashboard\/levels\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.levels.edit":{"uri":"dashboard\/levels\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.subjects.index":{"uri":"dashboard\/subjects","methods":["GET","HEAD"]},"filament.dashboard.resources.subjects.create":{"uri":"dashboard\/subjects\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.subjects.view":{"uri":"dashboard\/subjects\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.subjects.edit":{"uri":"dashboard\/subjects\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.tables.index":{"uri":"dashboard\/tables","methods":["GET","HEAD"]},"filament.dashboard.resources.tables.create":{"uri":"dashboard\/tables\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.tables.view":{"uri":"dashboard\/tables\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.tables.edit":{"uri":"dashboard\/tables\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.tables.schedule":{"uri":"dashboard\/tables\/{record}\/schedule","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.terms.index":{"uri":"dashboard\/terms","methods":["GET","HEAD"]},"filament.dashboard.resources.terms.create":{"uri":"dashboard\/terms\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.terms.view":{"uri":"dashboard\/terms\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.terms.edit":{"uri":"dashboard\/terms\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.users.index":{"uri":"dashboard\/users","methods":["GET","HEAD"]},"filament.dashboard.resources.users.create":{"uri":"dashboard\/users\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.users.view":{"uri":"dashboard\/users\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.users.edit":{"uri":"dashboard\/users\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.years.index":{"uri":"dashboard\/years","methods":["GET","HEAD"]},"filament.dashboard.resources.years.create":{"uri":"dashboard\/years\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.years.view":{"uri":"dashboard\/years\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.years.edit":{"uri":"dashboard\/years\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.permissions.index":{"uri":"dashboard\/permissions","methods":["GET","HEAD"]},"filament.dashboard.resources.permissions.create":{"uri":"dashboard\/permissions\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.permissions.edit":{"uri":"dashboard\/permissions\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.permissions.view":{"uri":"dashboard\/permissions\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.roles.index":{"uri":"dashboard\/roles","methods":["GET","HEAD"]},"filament.dashboard.resources.roles.create":{"uri":"dashboard\/roles\/create","methods":["GET","HEAD"]},"filament.dashboard.resources.roles.edit":{"uri":"dashboard\/roles\/{record}\/edit","methods":["GET","HEAD"],"parameters":["record"]},"filament.dashboard.resources.roles.view":{"uri":"dashboard\/roles\/{record}","methods":["GET","HEAD"],"parameters":["record"]},"filament.doctor.auth.logout":{"uri":"doctor\/logout","methods":["POST"]},"filament.doctor.pages.dashboard":{"uri":"doctor","methods":["GET","HEAD"]},"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"livewire.update":{"uri":"livewire\/update","methods":["POST"]},"livewire.upload-file":{"uri":"livewire\/upload-file","methods":["POST"]},"livewire.preview-file":{"uri":"livewire\/preview-file\/{filename}","methods":["GET","HEAD"],"parameters":["filename"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"collages":{"uri":"collages","methods":["GET","HEAD"]},"schedule":{"uri":"collages\/{collage}","methods":["GET","HEAD"],"parameters":["collage"],"bindings":{"collage":"id"}},"pdf":{"uri":"pdf","methods":["GET","HEAD"]},"profile.edit":{"uri":"profile","methods":["GET","HEAD"]},"profile.update":{"uri":"profile","methods":["PATCH"]},"profile.destroy":{"uri":"profile","methods":["DELETE"]},"register":{"uri":"register","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"],"parameters":["token"]},"password.store":{"uri":"reset-password","methods":["POST"]},"verification.notice":{"uri":"verify-email","methods":["GET","HEAD"]},"verification.verify":{"uri":"verify-email\/{id}\/{hash}","methods":["GET","HEAD"],"parameters":["id","hash"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirm":{"uri":"confirm-password","methods":["GET","HEAD"]},"password.update":{"uri":"password","methods":["PUT"]},"logout":{"uri":"logout","methods":["POST"]}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
