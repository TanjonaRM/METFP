# Export du projet Laravel

Généré le : 2026-09-20 09:11:02

## Table des matières

1. [.env](#-env)
2. [.env.example](#-env-example)
3. [.gitignore](#-gitignore)
4. [README.md](#readme-md)
5. [app/Application/Affectations/DTOs/CreateAffectationDTO.php](#app-application-affectations-dtos-createaffectationdto-php)
6. [app/Application/Affectations/DTOs/UpdateAffectationDTO.php](#app-application-affectations-dtos-updateaffectationdto-php)
7. [app/Application/Affectations/UseCases/CreateAffectationUseCase.php](#app-application-affectations-usecases-createaffectationusecase-php)
8. [app/Application/Affectations/UseCases/DeleteAffectationUseCase.php](#app-application-affectations-usecases-deleteaffectationusecase-php)
9. [app/Application/Affectations/UseCases/GetAffectationsUseCase.php](#app-application-affectations-usecases-getaffectationsusecase-php)
10. [app/Application/Affectations/UseCases/UpdateAffectationUseCase.php](#app-application-affectations-usecases-updateaffectationusecase-php)
11. [app/Application/Auth/DTOs/LoginDTO.php](#app-application-auth-dtos-logindto-php)
12. [app/Application/Auth/DTOs/RegisterAdminDTO.php](#app-application-auth-dtos-registeradmindto-php)
13. [app/Application/Auth/DTOs/RegisterFormateurDTO.php](#app-application-auth-dtos-registerformateurdto-php)
14. [app/Application/Auth/DTOs/ResetPasswordDTO.php](#app-application-auth-dtos-resetpassworddto-php)
15. [app/Application/Auth/DTOs/UpdatePasswordDTO.php](#app-application-auth-dtos-updatepassworddto-php)
16. [app/Application/Auth/Ports/AuthServiceInterface.php](#app-application-auth-ports-authserviceinterface-php)
17. [app/Application/Auth/Ports/MailServiceInterface.php](#app-application-auth-ports-mailserviceinterface-php)
18. [app/Application/Auth/Ports/SessionManagerInterface.php](#app-application-auth-ports-sessionmanagerinterface-php)
19. [app/Application/Auth/UseCases/Admin/LoginAdminUseCase.php](#app-application-auth-usecases-admin-loginadminusecase-php)
20. [app/Application/Auth/UseCases/Admin/LogoutAdminUseCase.php](#app-application-auth-usecases-admin-logoutadminusecase-php)
21. [app/Application/Auth/UseCases/Admin/RegisterAdminUseCase.php](#app-application-auth-usecases-admin-registeradminusecase-php)
22. [app/Application/Auth/UseCases/Admin/ResetAdminPasswordUseCase.php](#app-application-auth-usecases-admin-resetadminpasswordusecase-php)
23. [app/Application/Auth/UseCases/Formateur/LoginFormateurUseCase.php](#app-application-auth-usecases-formateur-loginformateurusecase-php)
24. [app/Application/Auth/UseCases/Formateur/LogoutFormateurUseCase.php](#app-application-auth-usecases-formateur-logoutformateurusecase-php)
25. [app/Application/Auth/UseCases/Formateur/RegisterFormateurUseCase.php](#app-application-auth-usecases-formateur-registerformateurusecase-php)
26. [app/Application/Auth/UseCases/Formateur/ResetFormateurPasswordUseCase.php](#app-application-auth-usecases-formateur-resetformateurpasswordusecase-php)
27. [app/Application/Dashboard/DTOs/DashboardStatsDTO.php](#app-application-dashboard-dtos-dashboardstatsdto-php)
28. [app/Application/Dashboard/UseCases/GetDashboardDataUseCase.php](#app-application-dashboard-usecases-getdashboarddatausecase-php)
29. [app/Application/Etablissements/DTOs/CreateEtablissementDTO.php](#app-application-etablissements-dtos-createetablissementdto-php)
30. [app/Application/Etablissements/DTOs/UpdateEtablissementDTO.php](#app-application-etablissements-dtos-updateetablissementdto-php)
31. [app/Application/Etablissements/UseCases/CreateEtablissementUseCase.php](#app-application-etablissements-usecases-createetablissementusecase-php)
32. [app/Application/Etablissements/UseCases/DeleteEtablissementUseCase.php](#app-application-etablissements-usecases-deleteetablissementusecase-php)
33. [app/Application/Etablissements/UseCases/GetEtablissementsUseCase.php](#app-application-etablissements-usecases-getetablissementsusecase-php)
34. [app/Application/Etablissements/UseCases/UpdateEtablissementUseCase.php](#app-application-etablissements-usecases-updateetablissementusecase-php)
35. [app/Application/Filieres/DTOs/CreateFiliereDTO.php](#app-application-filieres-dtos-createfilieredto-php)
36. [app/Application/Filieres/DTOs/UpdateFiliereDTO.php](#app-application-filieres-dtos-updatefilieredto-php)
37. [app/Application/Filieres/UseCases/CreateFiliereUseCase.php](#app-application-filieres-usecases-createfiliereusecase-php)
38. [app/Application/Filieres/UseCases/DeleteFiliereUseCase.php](#app-application-filieres-usecases-deletefiliereusecase-php)
39. [app/Application/Filieres/UseCases/GetFilieresUseCase.php](#app-application-filieres-usecases-getfilieresusecase-php)
40. [app/Application/Filieres/UseCases/UpdateFiliereUseCase.php](#app-application-filieres-usecases-updatefiliereusecase-php)
41. [app/Application/Formateurs/DTOs/CreateFormateurDTO.php](#app-application-formateurs-dtos-createformateurdto-php)
42. [app/Application/Formateurs/DTOs/FormateurResponseDTO.php](#app-application-formateurs-dtos-formateurresponsedto-php)
43. [app/Application/Formateurs/DTOs/UpdateFormateurDTO.php](#app-application-formateurs-dtos-updateformateurdto-php)
44. [app/Application/Formateurs/Ports/FormateurServiceInterface.php](#app-application-formateurs-ports-formateurserviceinterface-php)
45. [app/Application/Formateurs/UseCases/CreateFormateur/CreateFormateurCommand.php](#app-application-formateurs-usecases-createformateur-createformateurcommand-php)
46. [app/Application/Formateurs/UseCases/CreateFormateur/CreateFormateurUseCase.php](#app-application-formateurs-usecases-createformateur-createformateurusecase-php)
47. [app/Application/Formateurs/UseCases/DeleteFormateur/DeleteFormateurUseCase.php](#app-application-formateurs-usecases-deleteformateur-deleteformateurusecase-php)
48. [app/Application/Formateurs/UseCases/GetFormateurs/GetFormateursQuery.php](#app-application-formateurs-usecases-getformateurs-getformateursquery-php)
49. [app/Application/Formateurs/UseCases/GetFormateurs/GetFormateursUseCase.php](#app-application-formateurs-usecases-getformateurs-getformateursusecase-php)
50. [app/Application/Formateurs/UseCases/UpdateFormateur/UpdateFormateurCommand.php](#app-application-formateurs-usecases-updateformateur-updateformateurcommand-php)
51. [app/Application/Formateurs/UseCases/UpdateFormateur/UpdateFormateurUseCase.php](#app-application-formateurs-usecases-updateformateur-updateformateurusecase-php)
52. [app/Application/Niveaux/DTOs/CreateNiveauDTO.php](#app-application-niveaux-dtos-createniveaudto-php)
53. [app/Application/Niveaux/DTOs/UpdateNiveauDTO.php](#app-application-niveaux-dtos-updateniveaudto-php)
54. [app/Application/Niveaux/UseCases/CreateNiveauUseCase.php](#app-application-niveaux-usecases-createniveauusecase-php)
55. [app/Application/Niveaux/UseCases/DeleteNiveauUseCase.php](#app-application-niveaux-usecases-deleteniveauusecase-php)
56. [app/Application/Niveaux/UseCases/GetNiveauxUseCase.php](#app-application-niveaux-usecases-getniveauxusecase-php)
57. [app/Application/Niveaux/UseCases/UpdateNiveauUseCase.php](#app-application-niveaux-usecases-updateniveauusecase-php)
58. [app/Application/Notifications/Services/NotificationService.php](#app-application-notifications-services-notificationservice-php)
59. [app/Application/Secteurs/DTOs/CreateSecteurDTO.php](#app-application-secteurs-dtos-createsecteurdto-php)
60. [app/Application/Secteurs/DTOs/UpdateSecteurDTO.php](#app-application-secteurs-dtos-updatesecteurdto-php)
61. [app/Application/Secteurs/UseCases/CreateSecteurUseCase.php](#app-application-secteurs-usecases-createsecteurusecase-php)
62. [app/Application/Secteurs/UseCases/DeleteSecteurUseCase.php](#app-application-secteurs-usecases-deletesecteurusecase-php)
63. [app/Application/Secteurs/UseCases/GetSecteursUseCase.php](#app-application-secteurs-usecases-getsecteursusecase-php)
64. [app/Application/Secteurs/UseCases/UpdateSecteurUseCase.php](#app-application-secteurs-usecases-updatesecteurusecase-php)
65. [app/Application/Sessions/DTOs/CreateSessionDTO.php](#app-application-sessions-dtos-createsessiondto-php)
66. [app/Application/Sessions/DTOs/UpdateSessionDTO.php](#app-application-sessions-dtos-updatesessiondto-php)
67. [app/Application/Sessions/UseCases/CreateSessionUseCase.php](#app-application-sessions-usecases-createsessionusecase-php)
68. [app/Application/Sessions/UseCases/DeleteSessionUseCase.php](#app-application-sessions-usecases-deletesessionusecase-php)
69. [app/Application/Sessions/UseCases/GetSessionsUseCase.php](#app-application-sessions-usecases-getsessionsusecase-php)
70. [app/Application/Sessions/UseCases/UpdateSessionUseCase.php](#app-application-sessions-usecases-updatesessionusecase-php)
71. [app/Console/Commands/ExpireSessions.php](#app-console-commands-expiresessions-php)
72. [app/Console/Commands/ExportProjectCode.php](#app-console-commands-exportprojectcode-php)
73. [app/Console/Commands/InstallAffectations.php](#app-console-commands-installaffectations-php)
74. [app/Console/Commands/InstallAffectationsViews.php](#app-console-commands-installaffectationsviews-php)
75. [app/Console/Commands/InstallNotifications.php](#app-console-commands-installnotifications-php)
76. [app/Console/Commands/InstallRapports.php](#app-console-commands-installrapports-php)
77. [app/Console/Commands/InstallUsers.php](#app-console-commands-installusers-php)
78. [app/Console/Commands/ProjectInspect.php](#app-console-commands-projectinspect-php)
79. [app/Console/Commands/ProjectInspectNotifications.php](#app-console-commands-projectinspectnotifications-php)
80. [app/Console/Commands/ProjectInspectRapports.php](#app-console-commands-projectinspectrapports-php)
81. [app/Console/Commands/ProjectInspectUsers.php](#app-console-commands-projectinspectusers-php)
82. [app/Console/Commands/ProjectInstall.php](#app-console-commands-projectinstall-php)
83. [app/Domain/Affectations/Entities/Affectation.php](#app-domain-affectations-entities-affectation-php)
84. [app/Domain/Affectations/Exceptions/AffectationConflictException.php](#app-domain-affectations-exceptions-affectationconflictexception-php)
85. [app/Domain/Affectations/Ports/AffectationRepositoryInterface.php](#app-domain-affectations-ports-affectationrepositoryinterface-php)
86. [app/Domain/Affectations/Rules/AffectationRules.php](#app-domain-affectations-rules-affectationrules-php)
87. [app/Domain/Affectations/ValueObjects/DateAffectation.php](#app-domain-affectations-valueobjects-dateaffectation-php)
88. [app/Domain/Affectations/ValueObjects/StatutAffectation.php](#app-domain-affectations-valueobjects-statutaffectation-php)
89. [app/Domain/Auth/Entities/Admin.php](#app-domain-auth-entities-admin-php)
90. [app/Domain/Auth/Entities/FormateurUser.php](#app-domain-auth-entities-formateuruser-php)
91. [app/Domain/Auth/Entities/User.php](#app-domain-auth-entities-user-php)
92. [app/Domain/Auth/Exceptions/InvalidCredentialsException.php](#app-domain-auth-exceptions-invalidcredentialsexception-php)
93. [app/Domain/Auth/Exceptions/UnauthorizedException.php](#app-domain-auth-exceptions-unauthorizedexception-php)
94. [app/Domain/Auth/Exceptions/UserAlreadyExistsException.php](#app-domain-auth-exceptions-useralreadyexistsexception-php)
95. [app/Domain/Auth/Ports/AdminRepositoryInterface.php](#app-domain-auth-ports-adminrepositoryinterface-php)
96. [app/Domain/Auth/Ports/FormateurUserRepositoryInterface.php](#app-domain-auth-ports-formateuruserrepositoryinterface-php)
97. [app/Domain/Auth/Ports/PasswordHasherInterface.php](#app-domain-auth-ports-passwordhasherinterface-php)
98. [app/Domain/Auth/Ports/TokenGeneratorInterface.php](#app-domain-auth-ports-tokengeneratorinterface-php)
99. [app/Domain/Auth/Ports/UserRepositoryInterface.php](#app-domain-auth-ports-userrepositoryinterface-php)
100. [app/Domain/Auth/Rules/AuthRules.php](#app-domain-auth-rules-authrules-php)
101. [app/Domain/Auth/Rules/EmailRules.php](#app-domain-auth-rules-emailrules-php)
102. [app/Domain/Auth/Rules/PasswordRules.php](#app-domain-auth-rules-passwordrules-php)
103. [app/Domain/Auth/ValueObjects/Email.php](#app-domain-auth-valueobjects-email-php)
104. [app/Domain/Auth/ValueObjects/Password.php](#app-domain-auth-valueobjects-password-php)
105. [app/Domain/Auth/ValueObjects/Role.php](#app-domain-auth-valueobjects-role-php)
106. [app/Domain/Etablissements/Entities/Etablissement.php](#app-domain-etablissements-entities-etablissement-php)
107. [app/Domain/Etablissements/Exceptions/EtablissementNotFoundException.php](#app-domain-etablissements-exceptions-etablissementnotfoundexception-php)
108. [app/Domain/Etablissements/Ports/EtablissementRepositoryInterface.php](#app-domain-etablissements-ports-etablissementrepositoryinterface-php)
109. [app/Domain/Etablissements/Rules/EtablissementRules.php](#app-domain-etablissements-rules-etablissementrules-php)
110. [app/Domain/Etablissements/ValueObjects/Adresse.php](#app-domain-etablissements-valueobjects-adresse-php)
111. [app/Domain/Etablissements/ValueObjects/CodeEtablissement.php](#app-domain-etablissements-valueobjects-codeetablissement-php)
112. [app/Domain/Etablissements/ValueObjects/TypeEtablissement.php](#app-domain-etablissements-valueobjects-typeetablissement-php)
113. [app/Domain/Filieres/Entities/Filiere.php](#app-domain-filieres-entities-filiere-php)
114. [app/Domain/Filieres/Exceptions/FiliereNotFoundException.php](#app-domain-filieres-exceptions-filierenotfoundexception-php)
115. [app/Domain/Filieres/Ports/FiliereRepositoryInterface.php](#app-domain-filieres-ports-filiererepositoryinterface-php)
116. [app/Domain/Filieres/Rules/FiliereRules.php](#app-domain-filieres-rules-filiererules-php)
117. [app/Domain/Filieres/ValueObjects/CodeFiliere.php](#app-domain-filieres-valueobjects-codefiliere-php)
118. [app/Domain/Filieres/ValueObjects/LibelleFiliere.php](#app-domain-filieres-valueobjects-libellefiliere-php)
119. [app/Domain/Formateurs/Entities/Formateur.php](#app-domain-formateurs-entities-formateur-php)
120. [app/Domain/Formateurs/Exceptions/FormateurDejaExistantException.php](#app-domain-formateurs-exceptions-formateurdejaexistantexception-php)
121. [app/Domain/Formateurs/Exceptions/FormateurInvalideException.php](#app-domain-formateurs-exceptions-formateurinvalideexception-php)
122. [app/Domain/Formateurs/Exceptions/FormateurNotFoundException.php](#app-domain-formateurs-exceptions-formateurnotfoundexception-php)
123. [app/Domain/Formateurs/Ports/FormateurRepositoryInterface.php](#app-domain-formateurs-ports-formateurrepositoryinterface-php)
124. [app/Domain/Formateurs/Rules/FormateurRules.php](#app-domain-formateurs-rules-formateurrules-php)
125. [app/Domain/Formateurs/ValueObjects/Email.php](#app-domain-formateurs-valueobjects-email-php)
126. [app/Domain/Formateurs/ValueObjects/Matricule.php](#app-domain-formateurs-valueobjects-matricule-php)
127. [app/Domain/Formateurs/ValueObjects/NomComplet.php](#app-domain-formateurs-valueobjects-nomcomplet-php)
128. [app/Domain/Formateurs/ValueObjects/Statut.php](#app-domain-formateurs-valueobjects-statut-php)
129. [app/Domain/Formateurs/ValueObjects/Telephone.php](#app-domain-formateurs-valueobjects-telephone-php)
130. [app/Domain/Niveaux/Entities/Niveau.php](#app-domain-niveaux-entities-niveau-php)
131. [app/Domain/Niveaux/Ports/NiveauRepositoryInterface.php](#app-domain-niveaux-ports-niveaurepositoryinterface-php)
132. [app/Domain/Niveaux/Rules/NiveauRules.php](#app-domain-niveaux-rules-niveaurules-php)
133. [app/Domain/Niveaux/ValueObjects/CodeNiveau.php](#app-domain-niveaux-valueobjects-codeniveau-php)
134. [app/Domain/Secteurs/Entities/Secteur.php](#app-domain-secteurs-entities-secteur-php)
135. [app/Domain/Secteurs/Ports/SecteurRepositoryInterface.php](#app-domain-secteurs-ports-secteurrepositoryinterface-php)
136. [app/Domain/Secteurs/Rules/SecteurRules.php](#app-domain-secteurs-rules-secteurrules-php)
137. [app/Domain/Secteurs/ValueObjects/CodeSecteur.php](#app-domain-secteurs-valueobjects-codesecteur-php)
138. [app/Domain/Sessions/Entities/Session.php](#app-domain-sessions-entities-session-php)
139. [app/Domain/Sessions/Exceptions/SessionPleineException.php](#app-domain-sessions-exceptions-sessionpleineexception-php)
140. [app/Domain/Sessions/Ports/SessionRepositoryInterface.php](#app-domain-sessions-ports-sessionrepositoryinterface-php)
141. [app/Domain/Sessions/Rules/SessionRules.php](#app-domain-sessions-rules-sessionrules-php)
142. [app/Domain/Sessions/ValueObjects/CodeSession.php](#app-domain-sessions-valueobjects-codesession-php)
143. [app/Domain/Sessions/ValueObjects/NbPlaces.php](#app-domain-sessions-valueobjects-nbplaces-php)
144. [app/Domain/Sessions/ValueObjects/Periode.php](#app-domain-sessions-valueobjects-periode-php)
145. [app/Http/Controllers/Admin/AffectationController.php](#app-http-controllers-admin-affectationcontroller-php)
146. [app/Http/Controllers/Admin/DashboardController.php](#app-http-controllers-admin-dashboardcontroller-php)
147. [app/Http/Controllers/Admin/EtablissementController.php](#app-http-controllers-admin-etablissementcontroller-php)
148. [app/Http/Controllers/Admin/FiliereController.php](#app-http-controllers-admin-filierecontroller-php)
149. [app/Http/Controllers/Admin/FormateurController.php](#app-http-controllers-admin-formateurcontroller-php)
150. [app/Http/Controllers/Admin/NiveauController.php](#app-http-controllers-admin-niveaucontroller-php)
151. [app/Http/Controllers/Admin/NotificationController.php](#app-http-controllers-admin-notificationcontroller-php)
152. [app/Http/Controllers/Admin/PdfController.php](#app-http-controllers-admin-pdfcontroller-php)
153. [app/Http/Controllers/Admin/SecteurController.php](#app-http-controllers-admin-secteurcontroller-php)
154. [app/Http/Controllers/Admin/SessionController.php](#app-http-controllers-admin-sessioncontroller-php)
155. [app/Http/Controllers/Admin/UserController.php](#app-http-controllers-admin-usercontroller-php)
156. [app/Http/Controllers/Auth/Admin/ForgotPasswordController.php](#app-http-controllers-auth-admin-forgotpasswordcontroller-php)
157. [app/Http/Controllers/Auth/Admin/LoginController.php](#app-http-controllers-auth-admin-logincontroller-php)
158. [app/Http/Controllers/Auth/Admin/LogoutController.php](#app-http-controllers-auth-admin-logoutcontroller-php)
159. [app/Http/Controllers/Auth/Admin/RegisterController.php](#app-http-controllers-auth-admin-registercontroller-php)
160. [app/Http/Controllers/Auth/Admin/ResetPasswordController.php](#app-http-controllers-auth-admin-resetpasswordcontroller-php)
161. [app/Http/Controllers/Auth/Formateur/ForgotPasswordController.php](#app-http-controllers-auth-formateur-forgotpasswordcontroller-php)
162. [app/Http/Controllers/Auth/Formateur/LoginController.php](#app-http-controllers-auth-formateur-logincontroller-php)
163. [app/Http/Controllers/Auth/Formateur/LogoutController.php](#app-http-controllers-auth-formateur-logoutcontroller-php)
164. [app/Http/Controllers/Auth/Formateur/RegisterController.php](#app-http-controllers-auth-formateur-registercontroller-php)
165. [app/Http/Controllers/Auth/Formateur/ResetPasswordController.php](#app-http-controllers-auth-formateur-resetpasswordcontroller-php)
166. [app/Http/Controllers/Controller.php](#app-http-controllers-controller-php)
167. [app/Http/Controllers/Formateur/AffectationController.php](#app-http-controllers-formateur-affectationcontroller-php)
168. [app/Http/Controllers/Formateur/DashboardController.php](#app-http-controllers-formateur-dashboardcontroller-php)
169. [app/Http/Controllers/Formateur/PdfFormateurController.php](#app-http-controllers-formateur-pdfformateurcontroller-php)
170. [app/Http/Controllers/Formateur/ProfileController.php](#app-http-controllers-formateur-profilecontroller-php)
171. [app/Http/Controllers/Formateur/SessionController.php](#app-http-controllers-formateur-sessioncontroller-php)
172. [app/Http/Middleware/AdminMiddleware.php](#app-http-middleware-adminmiddleware-php)
173. [app/Http/Middleware/FormateurMiddleware.php](#app-http-middleware-formateurmiddleware-php)
174. [app/Http/Middleware/RedirectIfAdmin.php](#app-http-middleware-redirectifadmin-php)
175. [app/Http/Middleware/RedirectIfFormateur.php](#app-http-middleware-redirectifformateur-php)
176. [app/Http/Requests/Affectation/StoreAffectationRequest.php](#app-http-requests-affectation-storeaffectationrequest-php)
177. [app/Http/Requests/Affectation/UpdateAffectationRequest.php](#app-http-requests-affectation-updateaffectationrequest-php)
178. [app/Http/Requests/Auth/Admin/LoginAdminRequest.php](#app-http-requests-auth-admin-loginadminrequest-php)
179. [app/Http/Requests/Auth/Admin/RegisterAdminRequest.php](#app-http-requests-auth-admin-registeradminrequest-php)
180. [app/Http/Requests/Auth/Formateur/LoginFormateurRequest.php](#app-http-requests-auth-formateur-loginformateurrequest-php)
181. [app/Http/Requests/Auth/Formateur/RegisterFormateurRequest.php](#app-http-requests-auth-formateur-registerformateurrequest-php)
182. [app/Http/Requests/Etablissement/StoreEtablissementRequest.php](#app-http-requests-etablissement-storeetablissementrequest-php)
183. [app/Http/Requests/Etablissement/UpdateEtablissementRequest.php](#app-http-requests-etablissement-updateetablissementrequest-php)
184. [app/Http/Requests/Filiere/StoreFiliereRequest.php](#app-http-requests-filiere-storefiliererequest-php)
185. [app/Http/Requests/Filiere/UpdateFiliereRequest.php](#app-http-requests-filiere-updatefiliererequest-php)
186. [app/Http/Requests/Formateur/StoreFormateurRequest.php](#app-http-requests-formateur-storeformateurrequest-php)
187. [app/Http/Requests/Formateur/UpdateFormateurRequest.php](#app-http-requests-formateur-updateformateurrequest-php)
188. [app/Http/Requests/Niveau/StoreNiveauRequest.php](#app-http-requests-niveau-storeniveaurequest-php)
189. [app/Http/Requests/Niveau/UpdateNiveauRequest.php](#app-http-requests-niveau-updateniveaurequest-php)
190. [app/Http/Requests/Secteur/StoreSecteurRequest.php](#app-http-requests-secteur-storesecteurrequest-php)
191. [app/Http/Requests/Secteur/UpdateSecteurRequest.php](#app-http-requests-secteur-updatesecteurrequest-php)
192. [app/Http/Requests/Session/StoreSessionRequest.php](#app-http-requests-session-storesessionrequest-php)
193. [app/Http/Requests/Session/UpdateSessionRequest.php](#app-http-requests-session-updatesessionrequest-php)
194. [app/Http/Requests/User/StoreUserRequest.php](#app-http-requests-user-storeuserrequest-php)
195. [app/Http/Requests/User/UpdateUserRequest.php](#app-http-requests-user-updateuserrequest-php)
196. [app/Http/Resources/AffectationResource.php](#app-http-resources-affectationresource-php)
197. [app/Http/Resources/Auth/AdminResource.php](#app-http-resources-auth-adminresource-php)
198. [app/Http/Resources/Auth/FormateurUserResource.php](#app-http-resources-auth-formateuruserresource-php)
199. [app/Http/Resources/EtablissementResource.php](#app-http-resources-etablissementresource-php)
200. [app/Http/Resources/FiliereResource.php](#app-http-resources-filiereresource-php)
201. [app/Http/Resources/FormateurResource.php](#app-http-resources-formateurresource-php)
202. [app/Http/Resources/NiveauResource.php](#app-http-resources-niveauresource-php)
203. [app/Http/Resources/SecteurResource.php](#app-http-resources-secteurresource-php)
204. [app/Http/Resources/SessionResource.php](#app-http-resources-sessionresource-php)
205. [app/Http/ViewModels/DashboardViewModel.php](#app-http-viewmodels-dashboardviewmodel-php)
206. [app/Http/ViewModels/FormateurViewModel.php](#app-http-viewmodels-formateurviewmodel-php)
207. [app/Infrastructure/Adapters/Hashing/BcryptPasswordHasher.php](#app-infrastructure-adapters-hashing-bcryptpasswordhasher-php)
208. [app/Infrastructure/Adapters/Mail/LaravelMailService.php](#app-infrastructure-adapters-mail-laravelmailservice-php)
209. [app/Infrastructure/Adapters/Pdf/DompdfExporter.php](#app-infrastructure-adapters-pdf-dompdfexporter-php)
210. [app/Infrastructure/Adapters/Session/LaravelSessionManager.php](#app-infrastructure-adapters-session-laravelsessionmanager-php)
211. [app/Infrastructure/Adapters/Storage/LocalFileStorage.php](#app-infrastructure-adapters-storage-localfilestorage-php)
212. [app/Infrastructure/Adapters/Token/LaravelTokenGenerator.php](#app-infrastructure-adapters-token-laraveltokengenerator-php)
213. [app/Infrastructure/Persistence/Database/MySqlConnection.php](#app-infrastructure-persistence-database-mysqlconnection-php)
214. [app/Infrastructure/Persistence/Eloquent/Models/AdminModel.php](#app-infrastructure-persistence-eloquent-models-adminmodel-php)
215. [app/Infrastructure/Persistence/Eloquent/Models/AffectationModel.php](#app-infrastructure-persistence-eloquent-models-affectationmodel-php)
216. [app/Infrastructure/Persistence/Eloquent/Models/EtablissementModel.php](#app-infrastructure-persistence-eloquent-models-etablissementmodel-php)
217. [app/Infrastructure/Persistence/Eloquent/Models/FiliereModel.php](#app-infrastructure-persistence-eloquent-models-filieremodel-php)
218. [app/Infrastructure/Persistence/Eloquent/Models/FiliereOptionModel.php](#app-infrastructure-persistence-eloquent-models-filiereoptionmodel-php)
219. [app/Infrastructure/Persistence/Eloquent/Models/FormateurModel.php](#app-infrastructure-persistence-eloquent-models-formateurmodel-php)
220. [app/Infrastructure/Persistence/Eloquent/Models/FormateurUserModel.php](#app-infrastructure-persistence-eloquent-models-formateurusermodel-php)
221. [app/Infrastructure/Persistence/Eloquent/Models/NiveauModel.php](#app-infrastructure-persistence-eloquent-models-niveaumodel-php)
222. [app/Infrastructure/Persistence/Eloquent/Models/NotificationModel.php](#app-infrastructure-persistence-eloquent-models-notificationmodel-php)
223. [app/Infrastructure/Persistence/Eloquent/Models/SecteurModel.php](#app-infrastructure-persistence-eloquent-models-secteurmodel-php)
224. [app/Infrastructure/Persistence/Eloquent/Models/SessionModel.php](#app-infrastructure-persistence-eloquent-models-sessionmodel-php)
225. [app/Infrastructure/Persistence/Eloquent/Models/UserModel.php](#app-infrastructure-persistence-eloquent-models-usermodel-php)
226. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAdminRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentadminrepository-php)
227. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentaffectationrepository-php)
228. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentEtablissementRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentetablissementrepository-php)
229. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFiliereRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentfiliererepository-php)
230. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFormateurRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentformateurrepository-php)
231. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFormateurUserRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentformateuruserrepository-php)
232. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentNiveauRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentniveaurepository-php)
233. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentSecteurRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentsecteurrepository-php)
234. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentSessionRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentsessionrepository-php)
235. [app/Infrastructure/Persistence/Eloquent/Repositories/EloquentUserRepository.php](#app-infrastructure-persistence-eloquent-repositories-eloquentuserrepository-php)
236. [app/Infrastructure/Providers/HexagonalServiceProvider.php](#app-infrastructure-providers-hexagonalserviceprovider-php)
237. [app/Infrastructure/Services/PdfExporterInterface.php](#app-infrastructure-services-pdfexporterinterface-php)
238. [app/Models/Notification.php](#app-models-notification-php)
239. [app/Models/User.php](#app-models-user-php)
240. [app/Observers/AffectationObserver.php](#app-observers-affectationobserver-php)
241. [app/Observers/FormateurObserver.php](#app-observers-formateurobserver-php)
242. [app/Providers/AppServiceProvider.php](#app-providers-appserviceprovider-php)
243. [app/Providers/AuthServiceProvider.php](#app-providers-authserviceprovider-php)
244. [app/Providers/HexagonalServiceProvider.php](#app-providers-hexagonalserviceprovider-php)
245. [artisan](#artisan)
246. [bootstrap/app.php](#bootstrap-app-php)
247. [bootstrap/providers.php](#bootstrap-providers-php)
248. [composer.json](#composer-json)
249. [config/app.php](#config-app-php)
250. [config/auth.php](#config-auth-php)
251. [config/cache.php](#config-cache-php)
252. [config/database.php](#config-database-php)
253. [config/filesystems.php](#config-filesystems-php)
254. [config/hexagonal.php](#config-hexagonal-php)
255. [config/logging.php](#config-logging-php)
256. [config/mail.php](#config-mail-php)
257. [config/queue.php](#config-queue-php)
258. [config/services.php](#config-services-php)
259. [config/session.php](#config-session-php)
260. [database/.gitignore](#database--gitignore)
261. [database/factories/AdminFactory.php](#database-factories-adminfactory-php)
262. [database/factories/EtablissementFactory.php](#database-factories-etablissementfactory-php)
263. [database/factories/FiliereFactory.php](#database-factories-filierefactory-php)
264. [database/factories/FormateurFactory.php](#database-factories-formateurfactory-php)
265. [database/factories/FormateurUserFactory.php](#database-factories-formateuruserfactory-php)
266. [database/factories/NiveauFactory.php](#database-factories-niveaufactory-php)
267. [database/factories/SecteurFactory.php](#database-factories-secteurfactory-php)
268. [database/factories/SessionFactory.php](#database-factories-sessionfactory-php)
269. [database/factories/UserFactory.php](#database-factories-userfactory-php)
270. [database/migrations/0001_01_01_000000_create_users_table.php](#database-migrations-0001_01_01_000000_create_users_table-php)
271. [database/migrations/0001_01_01_000001_create_cache_table.php](#database-migrations-0001_01_01_000001_create_cache_table-php)
272. [database/migrations/0001_01_01_000002_create_jobs_table.php](#database-migrations-0001_01_01_000002_create_jobs_table-php)
273. [database/migrations/2024_01_01_000001_create_admins_table.php](#database-migrations-2024_01_01_000001_create_admins_table-php)
274. [database/migrations/2024_01_01_000002_create_formateurs_users_table.php](#database-migrations-2024_01_01_000002_create_formateurs_users_table-php)
275. [database/migrations/2024_01_01_000003_create_niveaux_table.php](#database-migrations-2024_01_01_000003_create_niveaux_table-php)
276. [database/migrations/2024_01_01_000004_create_secteurs_table.php](#database-migrations-2024_01_01_000004_create_secteurs_table-php)
277. [database/migrations/2024_01_01_000005_create_filieres_table.php](#database-migrations-2024_01_01_000005_create_filieres_table-php)
278. [database/migrations/2024_01_01_000006_create_etablissements_table.php](#database-migrations-2024_01_01_000006_create_etablissements_table-php)
279. [database/migrations/2024_01_01_000007_create_formateurs_table.php](#database-migrations-2024_01_01_000007_create_formateurs_table-php)
280. [database/migrations/2024_01_01_000008_create_formateur_filieres_table.php](#database-migrations-2024_01_01_000008_create_formateur_filieres_table-php)
281. [database/migrations/2024_01_01_000009_create_affectations_table.php](#database-migrations-2024_01_01_000009_create_affectations_table-php)
282. [database/migrations/2024_01_01_000010_create_sessions_table.php](#database-migrations-2024_01_01_000010_create_sessions_table-php)
283. [database/migrations/2024_01_01_000012_create_filiere_options_table.php](#database-migrations-2024_01_01_000012_create_filiere_options_table-php)
284. [database/migrations/2026_09_17_122707_create_notifications_table.php](#database-migrations-2026_09_17_122707_create_notifications_table-php)
285. [database/migrations/2026_09_17_134108_fix_notifications_table.php](#database-migrations-2026_09_17_134108_fix_notifications_table-php)
286. [database/migrations/2026_09_17_135508_drop_presences_table.php](#database-migrations-2026_09_17_135508_drop_presences_table-php)
287. [database/migrations/2026_09_17_135743_add_indexes_to_tables.php](#database-migrations-2026_09_17_135743_add_indexes_to_tables-php)
288. [database/migrations/2026_09_19_000001_add_matricule_seq_to_formateurs_table.php](#database-migrations-2026_09_19_000001_add_matricule_seq_to_formateurs_table-php)
289. [database/migrations/2026_09_19_000002_make_niveau_secteur_nullable_in_filieres.php](#database-migrations-2026_09_19_000002_make_niveau_secteur_nullable_in_filieres-php)
290. [database/migrations/2026_09_19_000003_add_contact_responsable_to_etablissements_table.php](#database-migrations-2026_09_19_000003_add_contact_responsable_to_etablissements_table-php)
291. [database/migrations/2026_09_19_121135_drop_matricule_sequences_table.php](#database-migrations-2026_09_19_121135_drop_matricule_sequences_table-php)
292. [database/migrations/2026_09_19_122450_update_sessions_statut_and_periode.php](#database-migrations-2026_09_19_122450_update_sessions_statut_and_periode-php)
293. [database/migrations/2026_09_19_183718__add_suspendu_to_formateurs_statut.php.php](#database-migrations-2026_09_19_183718__add_suspendu_to_formateurs_statut-php-php)
294. [database/migrations/2026_09_19_200000__unify_statuts_v2.php](#database-migrations-2026_09_19_200000__unify_statuts_v2-php)
295. [database/seeders/AdminSeeder.php](#database-seeders-adminseeder-php)
296. [database/seeders/AffectationSeeder.php](#database-seeders-affectationseeder-php)
297. [database/seeders/DatabaseSeeder.php](#database-seeders-databaseseeder-php)
298. [database/seeders/EtablissementSeeder.php](#database-seeders-etablissementseeder-php)
299. [database/seeders/FiliereSeeder.php](#database-seeders-filiereseeder-php)
300. [database/seeders/FormateurSeeder.php](#database-seeders-formateurseeder-php)
301. [database/seeders/FormateurUserSeeder.php](#database-seeders-formateuruserseeder-php)
302. [database/seeders/NiveauSeeder.php](#database-seeders-niveauseeder-php)
303. [database/seeders/SecteurSeeder.php](#database-seeders-secteurseeder-php)
304. [database/seeders/UserSeeder.php](#database-seeders-userseeder-php)
305. [export-lot04-final/2024_01_01_000006_create_etablissements_table.php](#export-lot04-final-2024_01_01_000006_create_etablissements_table-php)
306. [export-lot04-final/2024_01_01_000007_create_formateurs_table.php](#export-lot04-final-2024_01_01_000007_create_formateurs_table-php)
307. [export-lot04-final/2024_01_01_000008_create_formateur_filieres_table.php](#export-lot04-final-2024_01_01_000008_create_formateur_filieres_table-php)
308. [export-lot04-final/2024_01_01_000009_create_affectations_table.php](#export-lot04-final-2024_01_01_000009_create_affectations_table-php)
309. [export-lot04-final/2024_01_01_000010_create_sessions_table.php](#export-lot04-final-2024_01_01_000010_create_sessions_table-php)
310. [export-lot04-final/AffectationModel.php](#export-lot04-final-affectationmodel-php)
311. [export-lot04-final/AffectationObserver.php](#export-lot04-final-affectationobserver-php)
312. [export-lot04-final/AppServiceProvider.php](#export-lot04-final-appserviceprovider-php)
313. [export-lot04-final/EtablissementModel.php](#export-lot04-final-etablissementmodel-php)
314. [export-lot04-final/ExpireSessions.php](#export-lot04-final-expiresessions-php)
315. [export-lot04-final/FiliereModel.php](#export-lot04-final-filieremodel-php)
316. [export-lot04-final/FormateurModel.php](#export-lot04-final-formateurmodel-php)
317. [export-lot04-final/SessionModel.php](#export-lot04-final-sessionmodel-php)
318. [package-lock.json](#package-lock-json)
319. [package.json](#package-json)
320. [phpunit.xml](#phpunit-xml)
321. [public/index.php](#public-index-php)
322. [public/storage/.gitignore](#public-storage--gitignore)
323. [resources/css/app.css](#resources-css-app-css)
324. [resources/js/app.js](#resources-js-app-js)
325. [resources/js/bootstrap.js](#resources-js-bootstrap-js)
326. [resources/views/admin/affectations/create.blade.php](#resources-views-admin-affectations-create-blade-php)
327. [resources/views/admin/affectations/edit.blade.php](#resources-views-admin-affectations-edit-blade-php)
328. [resources/views/admin/affectations/index.blade.php](#resources-views-admin-affectations-index-blade-php)
329. [resources/views/admin/affectations/partials/form.blade.php](#resources-views-admin-affectations-partials-form-blade-php)
330. [resources/views/admin/affectations/partials/show.blade.php](#resources-views-admin-affectations-partials-show-blade-php)
331. [resources/views/admin/affectations/show.blade.php](#resources-views-admin-affectations-show-blade-php)
332. [resources/views/admin/dashboard/index.blade.php](#resources-views-admin-dashboard-index-blade-php)
333. [resources/views/admin/etablissements/create.blade.php](#resources-views-admin-etablissements-create-blade-php)
334. [resources/views/admin/etablissements/edit.blade.php](#resources-views-admin-etablissements-edit-blade-php)
335. [resources/views/admin/etablissements/index.blade.php](#resources-views-admin-etablissements-index-blade-php)
336. [resources/views/admin/etablissements/partials/form.blade.php](#resources-views-admin-etablissements-partials-form-blade-php)
337. [resources/views/admin/etablissements/show.blade.php](#resources-views-admin-etablissements-show-blade-php)
338. [resources/views/admin/filieres/create.blade.php](#resources-views-admin-filieres-create-blade-php)
339. [resources/views/admin/filieres/edit.blade.php](#resources-views-admin-filieres-edit-blade-php)
340. [resources/views/admin/filieres/index.blade.php](#resources-views-admin-filieres-index-blade-php)
341. [resources/views/admin/filieres/partials/form.blade.php](#resources-views-admin-filieres-partials-form-blade-php)
342. [resources/views/admin/filieres/show.blade.php](#resources-views-admin-filieres-show-blade-php)
343. [resources/views/admin/formateurs/create.blade.php](#resources-views-admin-formateurs-create-blade-php)
344. [resources/views/admin/formateurs/edit.blade.php](#resources-views-admin-formateurs-edit-blade-php)
345. [resources/views/admin/formateurs/index.blade.php](#resources-views-admin-formateurs-index-blade-php)
346. [resources/views/admin/formateurs/partials/filters.blade.php](#resources-views-admin-formateurs-partials-filters-blade-php)
347. [resources/views/admin/formateurs/partials/form.blade.php](#resources-views-admin-formateurs-partials-form-blade-php)
348. [resources/views/admin/formateurs/show.blade.php](#resources-views-admin-formateurs-show-blade-php)
349. [resources/views/admin/niveaux/create.blade.php](#resources-views-admin-niveaux-create-blade-php)
350. [resources/views/admin/niveaux/edit.blade.php](#resources-views-admin-niveaux-edit-blade-php)
351. [resources/views/admin/niveaux/index.blade.php](#resources-views-admin-niveaux-index-blade-php)
352. [resources/views/admin/niveaux/partials/form.blade.php](#resources-views-admin-niveaux-partials-form-blade-php)
353. [resources/views/admin/niveaux/show.blade.php](#resources-views-admin-niveaux-show-blade-php)
354. [resources/views/admin/notifications/index.blade.php](#resources-views-admin-notifications-index-blade-php)
355. [resources/views/admin/rapports/index.blade.php](#resources-views-admin-rapports-index-blade-php)
356. [resources/views/admin/secteurs/create.blade.php](#resources-views-admin-secteurs-create-blade-php)
357. [resources/views/admin/secteurs/edit.blade.php](#resources-views-admin-secteurs-edit-blade-php)
358. [resources/views/admin/secteurs/index.blade.php](#resources-views-admin-secteurs-index-blade-php)
359. [resources/views/admin/secteurs/partials/form.blade.php](#resources-views-admin-secteurs-partials-form-blade-php)
360. [resources/views/admin/secteurs/show.blade.php](#resources-views-admin-secteurs-show-blade-php)
361. [resources/views/admin/sessions/index.blade.php](#resources-views-admin-sessions-index-blade-php)
362. [resources/views/admin/sessions/show.blade.php](#resources-views-admin-sessions-show-blade-php)
363. [resources/views/admin/users/create.blade.php](#resources-views-admin-users-create-blade-php)
364. [resources/views/admin/users/edit.blade.php](#resources-views-admin-users-edit-blade-php)
365. [resources/views/admin/users/index.blade.php](#resources-views-admin-users-index-blade-php)
366. [resources/views/admin/users/partials/form.blade.php](#resources-views-admin-users-partials-form-blade-php)
367. [resources/views/admin/users/partials/show.blade.php](#resources-views-admin-users-partials-show-blade-php)
368. [resources/views/admin/users/show.blade.php](#resources-views-admin-users-show-blade-php)
369. [resources/views/auth/admin/forgot-password.blade.php](#resources-views-auth-admin-forgot-password-blade-php)
370. [resources/views/auth/admin/login.blade.php](#resources-views-auth-admin-login-blade-php)
371. [resources/views/auth/admin/register.blade.php](#resources-views-auth-admin-register-blade-php)
372. [resources/views/auth/admin/reset-password.blade.php](#resources-views-auth-admin-reset-password-blade-php)
373. [resources/views/auth/admin/verify-email.blade.php](#resources-views-auth-admin-verify-email-blade-php)
374. [resources/views/auth/formateur/forgot-password.blade.php](#resources-views-auth-formateur-forgot-password-blade-php)
375. [resources/views/auth/formateur/login.blade.php](#resources-views-auth-formateur-login-blade-php)
376. [resources/views/auth/formateur/register.blade.php](#resources-views-auth-formateur-register-blade-php)
377. [resources/views/auth/formateur/reset-password.blade.php](#resources-views-auth-formateur-reset-password-blade-php)
378. [resources/views/auth/formateur/verify-email.blade.php](#resources-views-auth-formateur-verify-email-blade-php)
379. [resources/views/emails/reset-password.blade.php](#resources-views-emails-reset-password-blade-php)
380. [resources/views/emails/verify-email.blade.php](#resources-views-emails-verify-email-blade-php)
381. [resources/views/errors/401.blade.php](#resources-views-errors-401-blade-php)
382. [resources/views/errors/403.blade.php](#resources-views-errors-403-blade-php)
383. [resources/views/errors/404.blade.php](#resources-views-errors-404-blade-php)
384. [resources/views/errors/419.blade.php](#resources-views-errors-419-blade-php)
385. [resources/views/errors/429.blade.php](#resources-views-errors-429-blade-php)
386. [resources/views/errors/500.blade.php](#resources-views-errors-500-blade-php)
387. [resources/views/errors/503.blade.php](#resources-views-errors-503-blade-php)
388. [resources/views/errors/layout.blade.php](#resources-views-errors-layout-blade-php)
389. [resources/views/formateur/affectations/index.blade.php](#resources-views-formateur-affectations-index-blade-php)
390. [resources/views/formateur/affectations/show.blade.php](#resources-views-formateur-affectations-show-blade-php)
391. [resources/views/formateur/dashboard/index.blade.php](#resources-views-formateur-dashboard-index-blade-php)
392. [resources/views/formateur/profile/edit.blade.php](#resources-views-formateur-profile-edit-blade-php)
393. [resources/views/formateur/sessions/index.blade.php](#resources-views-formateur-sessions-index-blade-php)
394. [resources/views/formateur/sessions/show.blade.php](#resources-views-formateur-sessions-show-blade-php)
395. [resources/views/layouts/admin.blade.php](#resources-views-layouts-admin-blade-php)
396. [resources/views/layouts/app.blade.php](#resources-views-layouts-app-blade-php)
397. [resources/views/layouts/formateur.blade.php](#resources-views-layouts-formateur-blade-php)
398. [resources/views/layouts/guest.blade.php](#resources-views-layouts-guest-blade-php)
399. [resources/views/layouts/navigation.blade.php](#resources-views-layouts-navigation-blade-php)
400. [resources/views/pdf/affectations/liste.blade.php](#resources-views-pdf-affectations-liste-blade-php)
401. [resources/views/pdf/formateurs/fiche.blade.php](#resources-views-pdf-formateurs-fiche-blade-php)
402. [resources/views/pdf/formateurs/liste.blade.php](#resources-views-pdf-formateurs-liste-blade-php)
403. [resources/views/pdf/formateurs/par-etablissement.blade.php](#resources-views-pdf-formateurs-par-etablissement-blade-php)
404. [resources/views/pdf/formateurs/par-filiere.blade.php](#resources-views-pdf-formateurs-par-filiere-blade-php)
405. [resources/views/pdf/layouts/base.blade.php](#resources-views-pdf-layouts-base-blade-php)
406. [resources/views/pdf/statistiques/global.blade.php](#resources-views-pdf-statistiques-global-blade-php)
407. [resources/views/welcome.blade.php](#resources-views-welcome-blade-php)
408. [routes/admin.php](#routes-admin-php)
409. [routes/auth.php](#routes-auth-php)
410. [routes/console.php](#routes-console-php)
411. [routes/formateur.php](#routes-formateur-php)
412. [routes/web.php](#routes-web-php)
413. [scripts/setup/snippets.md](#scripts-setup-snippets-md)
414. [tests/Feature/Admin/AllPagesTest.php](#tests-feature-admin-allpagestest-php)
415. [tests/Feature/Admin/FormateurControllerTest.php](#tests-feature-admin-formateurcontrollertest-php)
416. [tests/Feature/Auth/AdminAuthTest.php](#tests-feature-auth-adminauthtest-php)
417. [tests/Feature/ExampleTest.php](#tests-feature-exampletest-php)
418. [tests/Feature/Formateur/AllFormateurPagesTest.php](#tests-feature-formateur-allformateurpagestest-php)
419. [tests/TestCase.php](#tests-testcase-php)
420. [tests/Unit/Domain/Affectations/AffectationTest.php](#tests-unit-domain-affectations-affectationtest-php)
421. [tests/Unit/Domain/Etablissements/EtablissementTest.php](#tests-unit-domain-etablissements-etablissementtest-php)
422. [tests/Unit/Domain/Filieres/FiliereTest.php](#tests-unit-domain-filieres-filieretest-php)
423. [tests/Unit/Domain/Formateurs/Exceptions/FormateurInvalideExceptionTest.php](#tests-unit-domain-formateurs-exceptions-formateurinvalideexceptiontest-php)
424. [tests/Unit/Domain/Formateurs/FormateurTest.php](#tests-unit-domain-formateurs-formateurtest-php)
425. [tests/Unit/Domain/Formateurs/MatriculeTest.php](#tests-unit-domain-formateurs-matriculetest-php)
426. [tests/Unit/Domain/Formateurs/Rules/FormateurRulesTest.php](#tests-unit-domain-formateurs-rules-formateurrulestest-php)
427. [tests/Unit/Domain/Formateurs/ValueObjects/EmailTest.php](#tests-unit-domain-formateurs-valueobjects-emailtest-php)
428. [tests/Unit/Domain/Formateurs/ValueObjects/NomCompletTest.php](#tests-unit-domain-formateurs-valueobjects-nomcomplettest-php)
429. [tests/Unit/Domain/Formateurs/ValueObjects/StatutTest.php](#tests-unit-domain-formateurs-valueobjects-statuttest-php)
430. [tests/Unit/Domain/Formateurs/ValueObjects/TelephoneTest.php](#tests-unit-domain-formateurs-valueobjects-telephonetest-php)
431. [tests/Unit/Domain/Niveaux/NiveauTest.php](#tests-unit-domain-niveaux-niveautest-php)
432. [tests/Unit/Domain/Secteurs/SecteurTest.php](#tests-unit-domain-secteurs-secteurtest-php)
433. [tests/Unit/Domain/Sessions/SessionTest.php](#tests-unit-domain-sessions-sessiontest-php)
434. [tests/Unit/ExampleTest.php](#tests-unit-exampletest-php)
435. [vite.config.js](#vite-config-js)

---

## .env

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:uJXWzfE4JnsTY6zWuCCBXBXKKJKtFuRe8GSAMzEGx3E=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## .env.example

```example
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

# PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## .gitignore

```gitignore
*.log
.DS_Store
.env
.env.backup
.env.production
.phpactor.json
.phpunit.result.cache
/.fleet
/.idea
/.nova
/.phpunit.cache
/.vscode
/.zed
/auth.json
/node_modules
/public/build
/public/hot
/public/storage
/storage/*.key
/storage/pail
/vendor
Homestead.json
Homestead.yaml
Thumbs.db
```

## README.md

```md
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
```

## app/Application/Affectations/DTOs/CreateAffectationDTO.php

```php
<?php

namespace Application\Affectations\DTOs;

class CreateAffectationDTO
{
    public function __construct(
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            formateur_id:     (int) $data['formateur_id'],
            filiere_id:       (int) $data['filiere_id'],
            etablissement_id: (int) $data['etablissement_id'],
            date_debut:       $data['date_debut'],
            date_fin:         $data['date_fin'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'formateur_id'     => $this->formateur_id,
            'filiere_id'       => $this->filiere_id,
            'etablissement_id' => $this->etablissement_id,
            'date_debut'       => $this->date_debut,
            'date_fin'         => $this->date_fin,
            'statut'           => $this->statut,
        ];
    }
}
```

## app/Application/Affectations/DTOs/UpdateAffectationDTO.php

```php
<?php

namespace Application\Affectations\DTOs;

class UpdateAffectationDTO
{
    public function __construct(
        public int $id,
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id:               $id,
            formateur_id:     (int) $data['formateur_id'],
            filiere_id:       (int) $data['filiere_id'],
            etablissement_id: (int) $data['etablissement_id'],
            date_debut:       $data['date_debut'],
            date_fin:         $data['date_fin'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'formateur_id'     => $this->formateur_id,
            'filiere_id'       => $this->filiere_id,
            'etablissement_id' => $this->etablissement_id,
            'date_debut'       => $this->date_debut,
            'date_fin'         => $this->date_fin,
            'statut'           => $this->statut,
        ];
    }
}
```

## app/Application/Affectations/UseCases/CreateAffectationUseCase.php

```php
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\CreateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateAffectationUseCase
{
    public function execute(CreateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::create($dto->toArray());

        $code = SessionModel::generateNextCode();

        SessionModel::create([
            'code'             => $code,
            'titre'            => 'Session ' . ($affectation->filiere->libelle ?? ''),
            'filiere_id'       => $dto->filiere_id,
            'formateur_id'     => $dto->formateur_id,
            'etablissement_id' => $dto->etablissement_id,
            'date_debut'       => $dto->date_debut,
            'date_fin'         => $dto->date_fin ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'description'      => null,
            'statut'           => 'actif',
        ]);

        return $affectation;
    }
}
```

## app/Application/Affectations/UseCases/DeleteAffectationUseCase.php

```php
<?php

namespace Application\Affectations\UseCases;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class DeleteAffectationUseCase
{
    public function execute(int $id): void
    {
        $affectation = AffectationModel::findOrFail($id);
        $affectation->delete();
    }
}
```

## app/Application/Affectations/UseCases/GetAffectationsUseCase.php

```php

```

## app/Application/Affectations/UseCases/UpdateAffectationUseCase.php

```php
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\UpdateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class UpdateAffectationUseCase
{
    public function execute(UpdateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::findOrFail($dto->id);
        $affectation->update($dto->toArray());

        return $affectation;
    }
}
```

## app/Application/Auth/DTOs/LoginDTO.php

```php

```

## app/Application/Auth/DTOs/RegisterAdminDTO.php

```php

```

## app/Application/Auth/DTOs/RegisterFormateurDTO.php

```php

```

## app/Application/Auth/DTOs/ResetPasswordDTO.php

```php

```

## app/Application/Auth/DTOs/UpdatePasswordDTO.php

```php

```

## app/Application/Auth/Ports/AuthServiceInterface.php

```php

```

## app/Application/Auth/Ports/MailServiceInterface.php

```php

```

## app/Application/Auth/Ports/SessionManagerInterface.php

```php

```

## app/Application/Auth/UseCases/Admin/LoginAdminUseCase.php

```php

```

## app/Application/Auth/UseCases/Admin/LogoutAdminUseCase.php

```php

```

## app/Application/Auth/UseCases/Admin/RegisterAdminUseCase.php

```php

```

## app/Application/Auth/UseCases/Admin/ResetAdminPasswordUseCase.php

```php

```

## app/Application/Auth/UseCases/Formateur/LoginFormateurUseCase.php

```php

```

## app/Application/Auth/UseCases/Formateur/LogoutFormateurUseCase.php

```php

```

## app/Application/Auth/UseCases/Formateur/RegisterFormateurUseCase.php

```php

```

## app/Application/Auth/UseCases/Formateur/ResetFormateurPasswordUseCase.php

```php

```

## app/Application/Dashboard/DTOs/DashboardStatsDTO.php

```php
<?php

namespace Application\Dashboard\DTOs;

class DashboardStatsDTO
{
    public function __construct(
        public int $totalFormateurs,
        public int $totalEtablissements,
        public int $totalFilieres,
        public int $totalAffectations,
        public array $dernieresAffectations = [],
        public array $notifications = [],
        public array $formateursParEtablissement = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            totalFormateurs: $data['total_formateurs'] ?? 0,
            totalEtablissements: $data['total_etablissements'] ?? 0,
            totalFilieres: $data['total_filieres'] ?? 0,
            totalAffectations: $data['total_affectations'] ?? 0,
            dernieresAffectations: $data['dernieres_affectations'] ?? [],
            notifications: $data['notifications'] ?? [],
            formateursParEtablissement: $data['formateurs_par_etablissement'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'total_formateurs' => $this->totalFormateurs,
            'total_etablissements' => $this->totalEtablissements,
            'total_filieres' => $this->totalFilieres,
            'total_affectations' => $this->totalAffectations,
            'dernieres_affectations' => $this->dernieresAffectations,
            'notifications' => $this->notifications,
            'formateurs_par_etablissement' => $this->formateursParEtablissement,
        ];
    }
}
```

## app/Application/Dashboard/UseCases/GetDashboardDataUseCase.php

```php
<?php

namespace Application\Dashboard\UseCases;

use Application\Dashboard\DTOs\DashboardStatsDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\NotificationModel;

class GetDashboardDataUseCase
{
    public function execute(): DashboardStatsDTO
    {
        // Statistiques globales
        $totalFormateurs = FormateurModel::count();
        $totalEtablissements = EtablissementModel::count();
        $totalFilieres = FiliereModel::count();
        $totalAffectations = AffectationModel::count();

        // Dernières affectations (5 plus récentes)
        $dernieresAffectations = AffectationModel::with([
                'formateur',
                'filiere',
                'etablissement',
            ])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'formateur_nom' => $a->formateur?->nom . ' ' . $a->formateur?->prenom,
                'formateur_id' => $a->formateur_id,
                'formateur_matricule' => $a->formateur?->matricule,
                'filiere_libelle' => $a->filiere?->libelle,
                'etablissement_nom' => $a->etablissement?->nom,
                'date_debut' => $a->date_debut?->format('d/m/Y'),
                'date_fin' => $a->date_fin?->format('d/m/Y'),
                'statut' => $a->statut,
                'created_at' => $a->created_at?->diffForHumans(),
            ])
            ->toArray();

        // Notifications (10 plus récentes non lues)
        $notifications = NotificationModel::where('lu', false)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($n) => [
                'id' => $n->id,
                'titre' => $n->titre,
                'message' => $n->message,
                'type' => $n->type, // 'info', 'warning', 'success', 'danger'
                'icone' => $n->icone ?? 'bell',
                'lu' => $n->lu,
                'created_at' => $n->created_at?->diffForHumans(),
                'date' => $n->created_at?->format('d/m/Y H:i'),
            ])
            ->toArray();

        // Formateurs par établissement (pour graphique optionnel)
        $formateursParEtablissement = EtablissementModel::withCount('formateurs')
            ->orderBy('formateurs_count', 'desc')
            ->limit(5)
            ->get()
            ->map(fn($e) => [
                'nom' => $e->nom,
                'count' => $e->formateurs_count,
            ])
            ->toArray();

        return new DashboardStatsDTO(
            totalFormateurs: $totalFormateurs,
            totalEtablissements: $totalEtablissements,
            totalFilieres: $totalFilieres,
            totalAffectations: $totalAffectations,
            dernieresAffectations: $dernieresAffectations,
            notifications: $notifications,
            formateursParEtablissement: $formateursParEtablissement,
        );
    }

    /**
     * Récupère les formateurs d'un établissement (pour carte cliquable)
     */
    public function getFormateursByEtablissement(?int $etablissementId = null): array
    {
        $query = FormateurModel::with(['etablissement']);

        if ($etablissementId) {
            $query->where('etablissement_id', $etablissementId);
        }

        return $query->orderBy('nom')
            ->get()
            ->map(fn($f) => [
                'id' => $f->id,
                'matricule' => $f->matricule,
                'nom_complet' => $f->nom . ' ' . $f->prenom,
                'email' => $f->email,
                'telephone' => $f->telephone,
                'etablissement' => $f->etablissement?->nom,
                'statut' => $f->statut,
                'initiales' => strtoupper(substr($f->prenom, 0, 1) . substr($f->nom, 0, 1)),
            ])
            ->toArray();
    }

    /**
     * Recherche globale (formateurs + établissements)
     */
    public function search(string $term): array
    {
        $term = '%' . $term . '%';

        $formateurs = FormateurModel::where('nom', 'like', $term)
            ->orWhere('prenom', 'like', $term)
            ->orWhere('matricule', 'like', $term)
            ->orWhere('email', 'like', $term)
            ->limit(5)
            ->get()
            ->map(fn($f) => [
                'type' => 'formateur',
                'id' => $f->id,
                'label' => $f->nom . ' ' . $f->prenom . ' (' . $f->matricule . ')',
                'url' => route('admin.formateurs.show', $f->id),
            ]);

        $etablissements = EtablissementModel::where('nom', 'like', $term)
            ->orWhere('code', 'like', $term)
            ->limit(5)
            ->get()
            ->map(fn($e) => [
                'type' => 'etablissement',
                'id' => $e->id,
                'label' => $e->nom . ' (' . $e->code . ')',
                'url' => route('admin.etablissements.show', $e->id),
            ]);

        return $formateurs->concat($etablissements)->toArray();
    }
}
```

## app/Application/Etablissements/DTOs/CreateEtablissementDTO.php

```php
<?php

namespace Application\Etablissements\DTOs;

class CreateEtablissementDTO
{
    public function __construct(
        public string $code,
        public string $nom,
        public string $type = 'CFP',
        public ?string $region = null,
        public ?string $adresse = null,
        public ?string $telephone = null,
        public ?string $email = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            nom: $data['nom'],
            type: $data['type'] ?? 'CFP',
            region: $data['region'] ?? null,
            adresse: $data['adresse'] ?? null,
            telephone: $data['telephone'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}
```

## app/Application/Etablissements/DTOs/UpdateEtablissementDTO.php

```php
<?php

namespace Application\Etablissements\DTOs;

class UpdateEtablissementDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $nom,
        public string $type,
        public ?string $region = null,
        public ?string $adresse = null,
        public ?string $telephone = null,
        public ?string $email = null,
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            code: $data['code'],
            nom: $data['nom'],
            type: $data['type'],
            region: $data['region'] ?? null,
            adresse: $data['adresse'] ?? null,
            telephone: $data['telephone'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}
```

## app/Application/Etablissements/UseCases/CreateEtablissementUseCase.php

```php
<?php

namespace Application\Etablissements\UseCases;

use Application\Etablissements\DTOs\CreateEtablissementDTO;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class CreateEtablissementUseCase
{
    public function execute(CreateEtablissementDTO $dto): EtablissementModel
    {
        return EtablissementModel::create([
            'code' => $dto->code,
            'nom' => $dto->nom,
            'type' => $dto->type,
            'region' => $dto->region,
            'adresse' => $dto->adresse,
            'telephone' => $dto->telephone,
            'email' => $dto->email,
        ]);
    }
}
```

## app/Application/Etablissements/UseCases/DeleteEtablissementUseCase.php

```php
<?php

namespace Application\Etablissements\UseCases;

use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class DeleteEtablissementUseCase
{
    public function execute(int $id): void
    {
        EtablissementModel::findOrFail($id)->delete();
    }
}
```

## app/Application/Etablissements/UseCases/GetEtablissementsUseCase.php

```php
<?php

namespace Application\Etablissements\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class GetEtablissementsUseCase
{
    public function execute(): Collection
    {
        return EtablissementModel::withCount('formateurs')->get();
    }

    public function findById(int $id): ?EtablissementModel
    {
        return EtablissementModel::with(['formateurs', 'sessions'])->find($id);
    }
}
```

## app/Application/Etablissements/UseCases/UpdateEtablissementUseCase.php

```php
<?php

namespace Application\Etablissements\UseCases;

use Application\Etablissements\DTOs\UpdateEtablissementDTO;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class UpdateEtablissementUseCase
{
    public function execute(UpdateEtablissementDTO $dto): EtablissementModel
    {
        $model = EtablissementModel::findOrFail($dto->id);

        $model->update([
            'code' => $dto->code,
            'nom' => $dto->nom,
            'type' => $dto->type,
            'region' => $dto->region,
            'adresse' => $dto->adresse,
            'telephone' => $dto->telephone,
            'email' => $dto->email,
        ]);

        return $model;
    }
}
```

## app/Application/Filieres/DTOs/CreateFiliereDTO.php

```php
<?php

namespace Application\Filieres\DTOs;

class CreateFiliereDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
        public int $niveauId,
        public int $secteurId,
        public ?string $description = null,
        public array $options = [],
    ) {}

    public static function fromArray(array $data, array $options = []): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
            niveauId: (int) $data['niveau_id'],
            secteurId: (int) $data['secteur_id'],
            description: $data['description'] ?? null,
            options: $options,
        );
    }
}
```

## app/Application/Filieres/DTOs/UpdateFiliereDTO.php

```php

```

## app/Application/Filieres/UseCases/CreateFiliereUseCase.php

```php
<?php

namespace Application\Filieres\UseCases;

use Application\Filieres\DTOs\CreateFiliereDTO;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;

class CreateFiliereUseCase
{
    public function execute(CreateFiliereDTO $dto): FiliereModel
    {
        $filiere = FiliereModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'niveau_id' => $dto->niveauId,
            'secteur_id' => $dto->secteurId,
            'description' => $dto->description,
        ]);

        foreach ($dto->options as $opt) {
            $filiere->options()->create(['libelle' => $opt]);
        }

        return $filiere;
    }
}
```

## app/Application/Filieres/UseCases/DeleteFiliereUseCase.php

```php

```

## app/Application/Filieres/UseCases/GetFilieresUseCase.php

```php

```

## app/Application/Filieres/UseCases/UpdateFiliereUseCase.php

```php

```

## app/Application/Formateurs/DTOs/CreateFormateurDTO.php

```php
<?php

namespace Application\Formateurs\DTOs;

class CreateFormateurDTO
{
    public function __construct(
        public string $matricule,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $telephone = null,
        public ?string $sexe = null,
        public ?string $date_naissance = null,
        public ?string $lieu_naissance = null,
        public ?string $cin = null,
        public ?string $adresse = null,
        public ?string $grade = null,
        public ?string $date_recrutement = null,
        public ?string $photo = null,
        public ?int $etablissement_id = null,
        public ?int $filiere_id = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            matricule:        $data['matricule'],
            nom:              $data['nom'],
            prenom:           $data['prenom'],
            email:            $data['email'],
            telephone:        $data['telephone'] ?? null,
            sexe:             $data['sexe'] ?? null,
            date_naissance:   $data['date_naissance'] ?? null,
            lieu_naissance:   $data['lieu_naissance'] ?? null,
            cin:              $data['cin'] ?? null,
            adresse:          $data['adresse'] ?? null,
            grade:            $data['grade'] ?? null,
            date_recrutement: $data['date_recrutement'] ?? null,
            photo:            $data['photo'] ?? null,
            etablissement_id: isset($data['etablissement_id']) ? (int) $data['etablissement_id'] : null,
            filiere_id:       isset($data['filiere_id']) ? (int) $data['filiere_id'] : null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'matricule'        => $this->matricule,
            'nom'              => $this->nom,
            'prenom'           => $this->prenom,
            'email'            => $this->email,
            'telephone'        => $this->telephone,
            'sexe'             => $this->sexe,
            'date_naissance'   => $this->date_naissance,
            'lieu_naissance'   => $this->lieu_naissance,
            'cin'              => $this->cin,
            'adresse'          => $this->adresse,
            'grade'            => $this->grade,
            'date_recrutement' => $this->date_recrutement,
            'photo'            => $this->photo,
            'etablissement_id' => $this->etablissement_id,
            'filiere_id'       => $this->filiere_id,
            'statut'           => $this->statut,
        ];
    }
}
```

## app/Application/Formateurs/DTOs/FormateurResponseDTO.php

```php

```

## app/Application/Formateurs/DTOs/UpdateFormateurDTO.php

```php
<?php

namespace Application\Formateurs\DTOs;

class UpdateFormateurDTO
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $telephone = null,
        public ?int $etablissementId = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            nom: $data['nom'],
            prenom: $data['prenom'],
            email: $data['email'],
            telephone: $data['telephone'] ?? null,
            etablissementId: $data['etablissement_id'] ?? null,
            statut: $data['statut'] ?? 'actif',
        );
    }
}
```

## app/Application/Formateurs/Ports/FormateurServiceInterface.php

```php

```

## app/Application/Formateurs/UseCases/CreateFormateur/CreateFormateurCommand.php

```php

```

## app/Application/Formateurs/UseCases/CreateFormateur/CreateFormateurUseCase.php

```php
<?php

namespace Application\Formateurs\UseCases\CreateFormateur;

use Application\Formateurs\DTOs\CreateFormateurDTO;
use Application\Notifications\Services\NotificationService;
use Domain\Formateurs\Exceptions\FormateurDejaExistantException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(CreateFormateurDTO $dto): FormateurModel
    {
        // 1. Vérifier doublon
        $existing = $this->repository->findByMatricule($dto->matricule);
        if ($existing) {
            throw FormateurDejaExistantException::withMatricule($dto->matricule);
        }

        // 2. Sauvegarder TOUS les champs
        $savedFormateur = FormateurModel::create($dto->toArray());

        // 3. Créer la session si établissement + filière fournis
        if ($savedFormateur->id && $dto->filiere_id && $dto->etablissement_id) {
            $code = SessionModel::generateNextCode();

            SessionModel::create([
                'code'             => $code,
                'titre'            => null,
                'filiere_id'       => $dto->filiere_id,
                'formateur_id'     => $savedFormateur->id,
                'etablissement_id' => $dto->etablissement_id,
                'date_debut'       => $dto->date_recrutement ?? now()->toDateString(),
                'date_fin'         => now()->addMonths(6)->toDateString(),
                'nb_places'        => 0,
                'description'      => null,
                'statut'           => 'actif',
            ]);

            NotificationService::sessionCreee(
                $code,
                $dto->prenom . ' ' . $dto->nom,
                route('admin.sessions.index')
            );
        }

        // 4. Notification formateur créé
        NotificationService::formateurCree(
            $dto->prenom . ' ' . $dto->nom,
            $dto->matricule,
            route('admin.formateurs.show', $savedFormateur->id)
        );

        return $savedFormateur;
    }
}
```

## app/Application/Formateurs/UseCases/DeleteFormateur/DeleteFormateurUseCase.php

```php
<?php

namespace Application\Formateurs\UseCases\DeleteFormateur;

use Domain\Formateurs\Exceptions\FormateurNotFoundException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;

class DeleteFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(int $id): void
    {
        $existing = $this->repository->findById($id);
        if (!$existing) {
            throw FormateurNotFoundException::withId($id);
        }

        $this->repository->delete($id);
    }
}
```

## app/Application/Formateurs/UseCases/GetFormateurs/GetFormateursQuery.php

```php

```

## app/Application/Formateurs/UseCases/GetFormateurs/GetFormateursUseCase.php

```php
<?php

namespace Application\Formateurs\UseCases\GetFormateurs;

use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Illuminate\Support\Collection;

class GetFormateursUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(): Collection
    {
        return collect($this->repository->findAll());
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}
```

## app/Application/Formateurs/UseCases/UpdateFormateur/UpdateFormateurCommand.php

```php

```

## app/Application/Formateurs/UseCases/UpdateFormateur/UpdateFormateurUseCase.php

```php
<?php

namespace Application\Formateurs\UseCases\UpdateFormateur;

use Application\Formateurs\DTOs\UpdateFormateurDTO;
use Domain\Formateurs\Entities\Formateur;
use Domain\Formateurs\Exceptions\FormateurNotFoundException;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;

class UpdateFormateurUseCase
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
    ) {}

    public function execute(UpdateFormateurDTO $dto): Formateur
    {
        $existing = $this->repository->findById($dto->id);
        if (!$existing) {
            throw FormateurNotFoundException::withId($dto->id);
        }

        $updated = new Formateur(
            id: $dto->id,
            matricule: $existing->matricule,
            nom: $dto->nom,
            prenom: $dto->prenom,
            email: $dto->email,
            telephone: $dto->telephone,
            etablissementId: $dto->etablissementId,
            statut: $dto->statut,
        );

        return $this->repository->save($updated);
    }
}
```

## app/Application/Niveaux/DTOs/CreateNiveauDTO.php

```php
<?php

namespace Application\Niveaux\DTOs;

class CreateNiveauDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
            description: $data['description'] ?? null,
        );
    }
}
```

## app/Application/Niveaux/DTOs/UpdateNiveauDTO.php

```php
<?php

namespace Application\Niveaux\DTOs;

class UpdateNiveauDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id: $id,
            code: $data['code'],
            libelle: $data['libelle'],
            description: $data['description'] ?? null,
        );
    }
}
```

## app/Application/Niveaux/UseCases/CreateNiveauUseCase.php

```php
<?php

namespace Application\Niveaux\UseCases;

use Application\Niveaux\DTOs\CreateNiveauDTO;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class CreateNiveauUseCase
{
    public function execute(CreateNiveauDTO $dto): NiveauModel
    {
        return NiveauModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'description' => $dto->description,
        ]);
    }
}
```

## app/Application/Niveaux/UseCases/DeleteNiveauUseCase.php

```php
<?php

namespace Application\Niveaux\UseCases;

use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class DeleteNiveauUseCase
{
    public function execute(int $id): void
    {
        NiveauModel::findOrFail($id)->delete();
    }
}
```

## app/Application/Niveaux/UseCases/GetNiveauxUseCase.php

```php
<?php

namespace Application\Niveaux\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class GetNiveauxUseCase
{
    public function execute(): Collection
    {
        return NiveauModel::withCount('filieres')->get();
    }
}
```

## app/Application/Niveaux/UseCases/UpdateNiveauUseCase.php

```php
<?php

namespace Application\Niveaux\UseCases;

use Application\Niveaux\DTOs\UpdateNiveauDTO;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class UpdateNiveauUseCase
{
    public function execute(UpdateNiveauDTO $dto): NiveauModel
    {
        $model = NiveauModel::findOrFail($dto->id);
        $model->update([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
            'description' => $dto->description,
        ]);
        return $model;
    }
}
```

## app/Application/Notifications/Services/NotificationService.php

```php
<?php

namespace Application\Notifications\Services;

use App\Models\Notification;

class NotificationService
{
    /**
     * Crée une notification pour les admins
     */
    public static function creer(
        string $titre,
        string $message,
        string $type = 'info',
        string $icone = 'notifications',
        ?string $lien = null,
        ?int $userId = null,
        ?array $data = null
    ): Notification {
        return Notification::create([
            'user_id' => $userId,
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
            'icone' => $icone,
            'lu' => false,
            'lien' => $lien,
            'data' => $data,
        ]);
    }

    /**
     * Notifie la création d'un formateur
     */
    public static function formateurCree(string $nomComplet, string $matricule, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouveau formateur ajouté',
            message: "{$nomComplet} ({$matricule}) a été ajouté au système.",
            type: 'success',
            icone: 'person_add',
            lien: $lien,
        );
    }

    /**
     * Notifie la création d'un établissement
     */
    public static function etablissementCree(string $nom, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvel établissement créé',
            message: "L'établissement « {$nom} » a été créé.",
            type: 'success',
            icone: 'apartment',
            lien: $lien,
        );
    }

    /**
     * Notifie une affectation
     */
    public static function affectationCreee(string $formateur, string $filiere, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvelle affectation',
            message: "{$formateur} a été affecté à la filière « {$filiere} ».",
            type: 'info',
            icone: 'assignment_ind',
            lien: $lien,
        );
    }

    /**
     * Notifie une session créée
     */
    public static function sessionCreee(string $code, string $formateur, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Nouvelle session de formation',
            message: "Session {$code} créée pour {$formateur}.",
            type: 'info',
            icone: 'event',
            lien: $lien,
        );
    }

    /**
     * Notifie la modification d'une affectation
     */
    public static function affectationModifiee(string $formateur, ?string $lien = null): Notification
    {
        return self::creer(
            titre: 'Affectation modifiée',
            message: "L'affectation de {$formateur} a été modifiée.",
            type: 'warning',
            icone: 'edit',
            lien: $lien,
        );
    }

    /**
     * Notifie une suppression
     */
    public static function suppression(string $entite, string $nom): Notification
    {
        return self::creer(
            titre: 'Suppression effectuée',
            message: "L'élément « {$nom} » ({$entite}) a été supprimé.",
            type: 'danger',
            icone: 'delete',
        );
    }
}
```

## app/Application/Secteurs/DTOs/CreateSecteurDTO.php

```php
<?php

namespace Application\Secteurs\DTOs;

class CreateSecteurDTO
{
    public function __construct(
        public string $code,
        public string $libelle,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            libelle: $data['libelle'],
        );
    }
}
```

## app/Application/Secteurs/DTOs/UpdateSecteurDTO.php

```php

```

## app/Application/Secteurs/UseCases/CreateSecteurUseCase.php

```php
<?php

namespace Application\Secteurs\UseCases;

use Application\Secteurs\DTOs\CreateSecteurDTO;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class CreateSecteurUseCase
{
    public function execute(CreateSecteurDTO $dto): SecteurModel
    {
        return SecteurModel::create([
            'code' => $dto->code,
            'libelle' => $dto->libelle,
        ]);
    }
}
```

## app/Application/Secteurs/UseCases/DeleteSecteurUseCase.php

```php

```

## app/Application/Secteurs/UseCases/GetSecteursUseCase.php

```php
<?php

namespace Application\Secteurs\UseCases;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class GetSecteursUseCase
{
    public function execute(): Collection
    {
        return SecteurModel::withCount('filieres')->get();
    }
}
```

## app/Application/Secteurs/UseCases/UpdateSecteurUseCase.php

```php

```

## app/Application/Sessions/DTOs/CreateSessionDTO.php

```php

```

## app/Application/Sessions/DTOs/UpdateSessionDTO.php

```php

```

## app/Application/Sessions/UseCases/CreateSessionUseCase.php

```php

```

## app/Application/Sessions/UseCases/DeleteSessionUseCase.php

```php

```

## app/Application/Sessions/UseCases/GetSessionsUseCase.php

```php

```

## app/Application/Sessions/UseCases/UpdateSessionUseCase.php

```php

```

## app/Console/Commands/ExpireSessions.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class ExpireSessions extends Command
{
    protected $signature = 'sessions:expire';

    protected $description = 'Expire les sessions terminées et propage à toutes les entités liées';

    public function handle(): int
    {
        $today = now()->toDateString();

        // 1. Trouver les sessions actives expirées
        $sessionsExpirees = SessionModel::where('statut', SessionModel::STATUT_ACTIF)
            ->whereNotNull('date_fin')
            ->where('date_fin', '<', $today)
            ->get();

        $count = 0;

        foreach ($sessionsExpirees as $session) {
            // 2. Session → inactif
            $session->update([
                'statut'    => SessionModel::STATUT_INACTIF,
                'expire_le' => now(),
            ]);

            // 3. Formateur → inactif (source de vérité)
            //    → l'Observer FormateurObserver va propager à affectation, établissement, filière
            if ($session->formateur) {
                $session->formateur->update(['statut' => FormateurModel::STATUT_INACTIF]);
            }

            $count++;
        }

        $this->info("✅ {$count} session(s) expirée(s).");

        return self::SUCCESS;
    }
}
```

## app/Console/Commands/ExportProjectCode.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

class ExportProjectCode extends Command
{
    protected $signature = 'project:export 
                            {--output=project-export.md : Fichier de sortie}
                            {--format=md : Format (md|txt|json)}';

    protected $description = 'Exporte tout le code du projet (hors vendor, node_modules, etc.)';

    /**
     * Dossiers à exclure
     */
    protected array $excludedDirs = [
        'vendor',
        'node_modules',
        'storage',
        'bootstrap/cache',
        'public/build',
        'public/hot',
        '.git',
        '.idea',
        '.vscode',
        'database/database.sqlite',
    ];

    /**
     * Extensions de fichiers à inclure
     */
    protected array $includedExtensions = [
        'php', 'blade.php', 'js', 'ts', 'css', 'scss', 'vue',
        'json', 'md', 'env', 'yml', 'yaml', 'xml', 'html',
    ];

    /**
     * Fichiers spécifiques à inclure (sans extension ou config)
     */
    protected array $includedFiles = [
        '.env.example',
        '.gitignore',
        'composer.json',
        'package.json',
        'tailwind.config.js',
        'vite.config.js',
        'artisan',
    ];

    public function handle(): int
    {
        $output = $this->option('output');
        $format = $this->option('format');
        $basePath = base_path();

        $this->info("📦 Export du projet en cours...");

        $files = $this->collectFiles($basePath);

        $this->info("📄 " . count($files) . " fichiers trouvés");

        $content = match ($format) {
            'json' => $this->buildJson($files, $basePath),
            'txt'  => $this->buildTxt($files, $basePath),
            default => $this->buildMarkdown($files, $basePath),
        };

        file_put_contents($basePath . '/' . $output, $content);

        $size = round(strlen($content) / 1024, 2);
        $this->info("✅ Export terminé : {$output} ({$size} KB)");

        return self::SUCCESS;
    }

    protected function collectFiles(string $basePath): array
    {
        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($basePath, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);

            if ($this->isExcluded($relativePath)) {
                continue;
            }

            if ($this->isIncluded($relativePath)) {
                $files[] = $relativePath;
            }
        }

        sort($files);
        return $files;
    }

    protected function isExcluded(string $path): bool
    {
        foreach ($this->excludedDirs as $dir) {
            if (str_starts_with($path, $dir . '/') || $path === $dir) {
                return true;
            }
        }
        return false;
    }

    protected function isIncluded(string $path): bool
    {
        $filename = basename($path);

        // Fichiers explicitement inclus
        if (in_array($filename, $this->includedFiles, true)) {
            return true;
        }

        // Par extension
        foreach ($this->includedExtensions as $ext) {
            if (str_ends_with($filename, '.' . $ext)) {
                return true;
            }
        }

        return false;
    }

    protected function buildMarkdown(array $files, string $basePath): string
    {
        $out = "# Export du projet Laravel\n\n";
        $out .= "Généré le : " . now()->format('Y-m-d H:i:s') . "\n\n";
        $out .= "## Table des matières\n\n";

        foreach ($files as $i => $file) {
            $anchor = strtolower(str_replace(['/', '.'], ['-', '-'], $file));
            $out .= ($i + 1) . ". [{$file}](#{$anchor})\n";
        }

        $out .= "\n---\n\n";

        foreach ($files as $file) {
            $content = @file_get_contents($basePath . '/' . $file);
            if ($content === false) {
                continue;
            }

            $ext = pathinfo($file, PATHINFO_EXTENSION) ?: 'txt';
            if (str_contains($file, '.blade.php')) {
                $ext = 'blade';
            }

            $out .= "## {$file}\n\n";
            $out .= "```{$ext}\n";
            $out .= rtrim($content) . "\n";
            $out .= "```\n\n";
        }

        return $out;
    }

    protected function buildTxt(array $files, string $basePath): string
    {
        $out = "===========================================\n";
        $out .= "EXPORT DU PROJET - " . now()->format('Y-m-d H:i:s') . "\n";
        $out .= "===========================================\n\n";

        foreach ($files as $file) {
            $content = @file_get_contents($basePath . '/' . $file);
            if ($content === false) {
                continue;
            }

            $separator = str_repeat('=', 60);
            $out .= "{$separator}\n";
            $out .= "FICHIER: {$file}\n";
            $out .= "{$separator}\n\n";
            $out .= rtrim($content) . "\n\n\n";
        }

        return $out;
    }

    protected function buildJson(array $files, string $basePath): string
    {
        $data = [
            'generated_at' => now()->toIso8601String(),
            'files' => [],
        ];

        foreach ($files as $file) {
            $content = @file_get_contents($basePath . '/' . $file);
            if ($content === false) {
                continue;
            }
            $data['files'][$file] = $content;
        }

        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
```

## app/Console/Commands/InstallAffectations.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAffectations extends Command
{
    protected $signature = 'install:affectations';
    protected $description = 'Installe les fichiers du module Affectations';

    public function handle(): int
    {
        $this->info("Installation du module Affectations");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            'app/Application/Affectations/DTOs/CreateAffectationDTO.php' => <<<'PHP'
<?php

namespace Application\Affectations\DTOs;

class CreateAffectationDTO
{
    public function __construct(
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            formateur_id:     (int) $data['formateur_id'],
            filiere_id:       (int) $data['filiere_id'],
            etablissement_id: (int) $data['etablissement_id'],
            date_debut:       $data['date_debut'],
            date_fin:         $data['date_fin'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'formateur_id'     => $this->formateur_id,
            'filiere_id'       => $this->filiere_id,
            'etablissement_id' => $this->etablissement_id,
            'date_debut'       => $this->date_debut,
            'date_fin'         => $this->date_fin,
            'statut'           => $this->statut,
        ];
    }
}
PHP,

            'app/Application/Affectations/DTOs/UpdateAffectationDTO.php' => <<<'PHP'
<?php

namespace Application\Affectations\DTOs;

class UpdateAffectationDTO
{
    public function __construct(
        public int $id,
        public int $formateur_id,
        public int $filiere_id,
        public int $etablissement_id,
        public string $date_debut,
        public ?string $date_fin = null,
        public string $statut = 'actif',
    ) {}

    public static function fromArray(int $id, array $data): self
    {
        return new self(
            id:               $id,
            formateur_id:     (int) $data['formateur_id'],
            filiere_id:       (int) $data['filiere_id'],
            etablissement_id: (int) $data['etablissement_id'],
            date_debut:       $data['date_debut'],
            date_fin:         $data['date_fin'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'formateur_id'     => $this->formateur_id,
            'filiere_id'       => $this->filiere_id,
            'etablissement_id' => $this->etablissement_id,
            'date_debut'       => $this->date_debut,
            'date_fin'         => $this->date_fin,
            'statut'           => $this->statut,
        ];
    }
}
PHP,

            'app/Application/Affectations/UseCases/CreateAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\CreateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class CreateAffectationUseCase
{
    public function execute(CreateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::create($dto->toArray());

        $code = SessionModel::generateNextCode();

        SessionModel::create([
            'code'             => $code,
            'titre'            => 'Session ' . ($affectation->filiere->libelle ?? ''),
            'filiere_id'       => $dto->filiere_id,
            'formateur_id'     => $dto->formateur_id,
            'etablissement_id' => $dto->etablissement_id,
            'date_debut'       => $dto->date_debut,
            'date_fin'         => $dto->date_fin ?? now()->addMonths(6)->toDateString(),
            'nb_places'        => 0,
            'description'      => null,
            'statut'           => 'actif',
        ]);

        return $affectation;
    }
}
PHP,

            'app/Application/Affectations/UseCases/UpdateAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Application\Affectations\DTOs\UpdateAffectationDTO;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class UpdateAffectationUseCase
{
    public function execute(UpdateAffectationDTO $dto): AffectationModel
    {
        $affectation = AffectationModel::findOrFail($dto->id);
        $affectation->update($dto->toArray());

        return $affectation;
    }
}
PHP,

            'app/Application/Affectations/UseCases/DeleteAffectationUseCase.php' => <<<'PHP'
<?php

namespace Application\Affectations\UseCases;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class DeleteAffectationUseCase
{
    public function execute(int $id): void
    {
        $affectation = AffectationModel::findOrFail($id);
        $affectation->delete();
    }
}
PHP,

            'app/Http/Requests/Affectation/StoreAffectationRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }

    public function messages(): array
    {
        return [
            'formateur_id.required'     => 'Le formateur est obligatoire.',
            'filiere_id.required'       => 'La filière est obligatoire.',
            'etablissement_id.required' => 'L\'établissement est obligatoire.',
            'date_debut.required'       => 'La date de début est obligatoire.',
            'date_fin.after_or_equal'   => 'La date de fin doit être après la date de début.',
            'statut.in'                 => 'Le statut doit être : actif, termine ou suspendu.',
        ];
    }
}
PHP,

            'app/Http/Requests/Affectation/UpdateAffectationRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }
}
PHP,

            'app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php' => <<<'PHP'
<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class EloquentAffectationRepository
{
    public function findById(int $id): ?AffectationModel
    {
        return AffectationModel::find($id);
    }

    public function findAll(): array
    {
        return AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function findByFormateur(int $formateurId): array
    {
        return AffectationModel::where('formateur_id', $formateurId)
            ->with(['filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function save(array $data): AffectationModel
    {
        if (isset($data['id']) && $data['id']) {
            $model = AffectationModel::findOrFail($data['id']);
            $model->update($data);
            return $model;
        }
        return AffectationModel::create($data);
    }

    public function delete(int $id): void
    {
        AffectationModel::findOrFail($id)->delete();
    }
}
PHP,
        ];
    }
}
```

## app/Console/Commands/InstallAffectationsViews.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAffectationsViews extends Command
{
    protected $signature = 'install:affectations-views';
    protected $description = 'Installe les vues du module Affectations (sobre + modal + vert principal)';

    public function handle(): int
    {
        $this->info("Installation des vues Affectations");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // 1. PARTIALS FORM
            // =====================================================
            'resources/views/admin/affectations/partials/form.blade.php' => <<<'BLADE'
<div class="space-y-5">

    {{-- ========== SECTION : AFFECTATION ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">link</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Affectation</h3>
        </div>

        <div class="space-y-4">

            {{-- Formateur --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Formateur <span class="text-red-600">*</span>
                </label>
                <select name="formateur_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner un formateur —</option>
                    @foreach($formateurs ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('formateur_id', $affectation->formateur_id ?? '') == $f->id)>
                            {{ $f->nom }} {{ $f->prenom }} ({{ $f->matricule }})
                        </option>
                    @endforeach
                </select>
                @error('formateur_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Filière --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Filière <span class="text-red-600">*</span>
                </label>
                <select name="filiere_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner une filière —</option>
                    @foreach($filieres ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('filiere_id', $affectation->filiere_id ?? '') == $f->id)>
                            {{ $f->libelle }} ({{ $f->code }})
                        </option>
                    @endforeach
                </select>
                @error('filiere_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Établissement --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Établissement <span class="text-red-600">*</span>
                </label>
                <select name="etablissement_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner un établissement —</option>
                    @foreach($etablissements ?? [] as $e)
                        <option value="{{ $e->id }}" @selected(old('etablissement_id', $affectation->etablissement_id ?? '') == $e->id)>
                            {{ $e->nom }} ({{ $e->code }})
                        </option>
                    @endforeach
                </select>
                @error('etablissement_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- ========== SECTION : PÉRIODE ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">event</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Période</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Date de début <span class="text-red-600">*</span>
                </label>
                <input type="date" name="date_debut"
                       value="{{ old('date_debut', isset($affectation) && $affectation->date_debut ? $affectation->date_debut->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('date_debut')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Date de fin</label>
                <input type="date" name="date_fin"
                       value="{{ old('date_fin', isset($affectation) && $affectation->date_fin ? $affectation->date_fin->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                @error('date_fin')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-500 mt-1.5">Laisser vide si en cours</p>
            </div>

        </div>
    </div>

    {{-- ========== SECTION : STATUT ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">toggle_on</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Statut</h3>
        </div>

        @php $currentStatut = old('statut', $affectation->statut ?? 'actif'); @endphp

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="actif" class="peer sr-only"
                       @checked($currentStatut === 'actif')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-brand-700 peer-checked:bg-brand-50
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-brand-700 text-3xl">check_circle</span>
                    <span class="text-sm font-bold text-slate-900">Actif</span>
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="suspendu" class="peer sr-only"
                       @checked($currentStatut === 'suspendu')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-amber-600 peer-checked:bg-amber-50
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-amber-600 text-3xl">pause_circle</span>
                    <span class="text-sm font-bold text-slate-900">Suspendu</span>
                </div>
            </label>

            <label class="cursor-pointer">
                <input type="radio" name="statut" value="termine" class="peer sr-only"
                       @checked($currentStatut === 'termine')>
                <div class="flex flex-col items-center gap-1.5 px-3 py-4
                            border-2 border-slate-300 rounded-md
                            transition-all
                            hover:border-slate-400 hover:bg-slate-50
                            peer-checked:border-slate-700 peer-checked:bg-slate-100
                            peer-checked:shadow-md">
                    <span class="material-symbols-rounded text-slate-700 text-3xl">cancel</span>
                    <span class="text-sm font-bold text-slate-900">Terminé</span>
                </div>
            </label>

        </div>

        @error('statut')
            <p class="text-sm text-red-600 mt-3">{{ $message }}</p>
        @enderror
    </div>

</div>
BLADE,

            // =====================================================
            // 2. INDEX VIEW (avec 3 MODALS : Create / Edit / Show)
            // =====================================================
            'resources/views/admin/affectations/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Affectations')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Affectations</h1>
        <p class="text-sm text-slate-500 mt-1">Liste des affectations des formateurs</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.pdf.affectations') }}" target="_blank" class="btn-secondary">
            <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
            PDF
        </a>
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouvelle affectation
        </button>
    </div>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher un formateur..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md
                          focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="etablissement_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="filiere_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Toutes les filières</option>
            @foreach($filieres ?? [] as $f)
                <option value="{{ $f->id }}" @selected(request('filiere_id') == $f->id)>{{ $f->libelle }}</option>
            @endforeach
        </select>
        <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="termine" @selected(request('statut') === 'termine')>Terminé</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="md:col-span-5 flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($affectations ?? [] as $a)
            <tr>
                <td>
                    <a href="{{ route('admin.formateurs.show', $a->formateur->id ?? 0) }}" class="flex items-center gap-2 group">
                        <div class="avatar avatar-sm avatar-primary">
                            {{ strtoupper(substr($a->formateur->prenom ?? 'U', 0, 1) . substr($a->formateur->nom ?? 'N', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm group-hover:text-brand-700">{{ $a->formateur->nom ?? '—' }} {{ $a->formateur->prenom ?? '' }}</div>
                            <div class="text-[10px] text-slate-500 font-mono">{{ $a->formateur->matricule ?? '' }}</div>
                        </div>
                    </a>
                </td>
                <td class="font-semibold">{{ $a->filiere->libelle ?? '—' }}</td>
                <td>{{ $a->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} → {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'termine')
                        <span class="badge-gray">Terminé</span>
                    @else
                        <span class="badge-warning">Suspendu</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        <form action="{{ route('admin.affectations.destroy', $a->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                <span class="material-symbols-rounded text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucune affectation trouvée</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $affectations->total() ?? 0 }} affectations</span>
        <div>{{ $affectations->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeCreateModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">add_task</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouvelle affectation</h2>
                    <p class="text-xs text-slate-500">Créer une affectation pour un formateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.affectations.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeEditModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier l'affectation</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;"
     onclick="if(event.target === this) closeShowModal()">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail de l'affectation</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<style>
    #createModal:not([style*="display:none"]),
    #editModal:not([style*="display:none"]),
    #showModal:not([style*="display:none"]) {
        display: flex !important;
    }

    body.modal-open {
        overflow: hidden !important;
    }
</style>

<script>
    console.log('✅ Script affectations chargé');

    // ============ CREATE ============
    function openCreateModal() {
        console.log('🔵 Ouverture modal CREATE');
        const modal = document.getElementById('createModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        fetch('{{ route("admin.affectations.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('📦 Formulaire CREATE chargé');
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ EDIT ============
    function openEditModal(id) {
        console.log('🔵 Ouverture modal EDIT', id);
        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        const form = document.getElementById('editForm');
        form.action = `/admin/affectations/${id}`;

        fetch(`/admin/affectations/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('📦 Formulaire EDIT chargé');
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ SHOW ============
    function openShowModal(id) {
        console.log('🔵 Ouverture modal SHOW', id);
        const modal = document.getElementById('showModal');
        modal.style.display = 'flex';
        document.body.classList.add('modal-open');

        fetch(`/admin/affectations/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => {
            if (r.headers.get('content-type')?.includes('application/json')) {
                return r.json().then(data => ({ html: data.html }));
            }
            return r.text().then(html => ({ html }));
        })
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeShowModal() {
        document.getElementById('showModal').style.display = 'none';
        document.body.classList.remove('modal-open');
    }

    // ============ SUBMIT AJAX (délégation) ============
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('📤 Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('✅ Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('❌', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ============ ECHAP ============
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
            closeShowModal();
        }
    });
</script>

@endsection
BLADE,
        ];
    }
}
```

## app/Console/Commands/InstallNotifications.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallNotifications extends Command
{
    protected $signature = 'install:notifications';
    protected $description = 'Installe le module Notifications (page dédiée + filtres)';

    public function handle(): int
    {
        $this->info("Installation du module Notifications");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            'app/Http/Controllers/Admin/NotificationController.php' => <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::query()->latest();

        if ($request->filled('statut')) {
            if ($request->statut === 'non_lues') {
                $query->where('lu', false);
            } elseif ($request->statut === 'lues') {
                $query->where('lu', true);
            }
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

        $stats = [
            'total'    => Notification::count(),
            'non_lues' => Notification::where('lu', false)->count(),
            'lues'     => Notification::where('lu', true)->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats'));
    }

    public function markAsRead(int $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification marquée comme lue.');
    }

    public function markAllAsRead()
    {
        Notification::where('lu', false)->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Toutes les notifications sont marquées comme lues.');
    }

    public function destroy(int $id)
    {
        Notification::findOrFail($id)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification supprimée.');
    }

    public function destroyAll()
    {
        Notification::where('lu', true)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notifications lues supprimées.');
    }
}
PHP,

            'resources/views/admin/notifications/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Notifications')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl" style="font-variation-settings: 'FILL' 1;">notifications</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Notifications</h1>
                <p class="text-sm text-slate-500 mt-1">Toutes les activités récentes du système</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            @if($stats['non_lues'] > 0)
                <form method="POST" action="{{ route('admin.notifications.read-all') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        <span class="material-symbols-rounded text-lg">done_all</span>
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
            @if($stats['lues'] > 0)
                <form method="POST" action="{{ route('admin.notifications.destroy-all') }}" class="inline"
                      onsubmit="return confirm('Supprimer toutes les notifications lues ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-secondary text-red-600 hover:bg-red-50">
                        <span class="material-symbols-rounded text-lg">delete_sweep</span>
                        Supprimer les lues
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Non lues</div>
            <div class="text-2xl font-bold text-brand-700 mt-1">{{ $stats['non_lues'] }}</div>
        </div>
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Lues</div>
            <div class="text-2xl font-bold text-slate-400 mt-1">{{ $stats['lues'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl border-2 border-slate-300 p-4 mb-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher une notification..."
                       class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
            </div>
            <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                <option value="">Tous les statuts</option>
                <option value="non_lues" @selected(request('statut') === 'non_lues')>Non lues</option>
                <option value="lues" @selected(request('statut') === 'lues')>Lues</option>
            </select>
            <select name="type" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                <option value="">Tous les types</option>
                <option value="info" @selected(request('type') === 'info')>Info</option>
                <option value="success" @selected(request('type') === 'success')>Succès</option>
                <option value="warning" @selected(request('type') === 'warning')>Avertissement</option>
                <option value="danger" @selected(request('type') === 'danger')>Danger</option>
            </select>
            <div class="md:col-span-4 flex items-center gap-2">
                <button type="submit" class="btn-primary">Filtrer</button>
                <a href="{{ route('admin.notifications.index') }}" class="btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border-2 border-slate-300 overflow-hidden">
        @forelse($notifications as $notif)
            @php
                $colors = [
                    'info'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200'],
                    'success' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200'],
                    'warning' => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-200'],
                    'danger'  => ['bg' => 'bg-red-50',     'text' => 'text-red-600',     'border' => 'border-red-200'],
                ];
                $c = $colors[$notif->type] ?? $colors['info'];
            @endphp

            <div class="flex items-start gap-4 px-5 py-4 border-b border-slate-200 last:border-0 transition {{ $notif->lu ? 'opacity-60' : 'bg-white' }}">
                <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} border {{ $c['border'] }} flex items-center justify-center shrink-0">
                    <span class="material-symbols-rounded {{ $c['text'] }} text-xl">{{ $notif->icone ?? 'info' }}</span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <div class="font-bold text-slate-900">{{ $notif->titre }}</div>
                            <div class="text-sm text-slate-600 mt-0.5">{{ $notif->message }}</div>
                        </div>
                        <div class="text-xs text-slate-400 whitespace-nowrap">
                            {{ $notif->created_at?->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-2">
                        @if($notif->lien)
                            <a href="{{ $notif->lien }}" class="text-xs font-semibold text-brand-700 hover:text-brand-800">
                                Voir →
                            </a>
                        @endif

                        @if(!$notif->lu)
                            <form method="POST" action="{{ route('admin.notifications.mark-read', $notif->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-slate-700">
                                    Marquer comme lu
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.notifications.destroy', $notif->id) }}" class="inline"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">notifications_off</span>
                <p class="text-slate-500">Aucune notification</p>
            </div>
        @endforelse

        @if($notifications->hasPages())
            <div class="px-4 py-3 border-t border-slate-200">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
BLADE,

            'routes/admin.php' => <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\EtablissementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PdfController;

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('formateurs', FormateurController::class);
        Route::resource('etablissements', EtablissementController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('affectations', AffectationController::class);

        Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/destroy-all', [NotificationController::class, 'destroyAll'])->name('destroy-all');
        });

        Route::resource('users', UserController::class);

        Route::prefix('pdf')->name('pdf.')->group(function () {
            Route::get('/', [PdfController::class, 'index'])->name('index');
            Route::get('/formateurs', [PdfController::class, 'formateurs'])->name('formateurs');
            Route::get('/formateurs/par-etablissement', [PdfController::class, 'formateursParEtablissement'])->name('formateurs.par-etablissement');
            Route::get('/formateurs/par-filiere', [PdfController::class, 'formateursParFiliere'])->name('formateurs.par-filiere');
            Route::get('/formateurs/{id}', [PdfController::class, 'formateur'])->where('id', '[0-9]+')->name('formateur');
            Route::get('/affectations', [PdfController::class, 'affectations'])->name('affectations');
            Route::get('/statistiques', [PdfController::class, 'statistiques'])->name('statistiques');
        });

        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::get('/formateurs-by-etablissement', [DashboardController::class, 'formateursByEtablissement'])->name('formateurs.by.etablissement');
    });
PHP,
        ];
    }
}
```

## app/Console/Commands/InstallRapports.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallRapports extends Command
{
    protected $signature = 'install:rapports';
    protected $description = 'Installe le module Rapports + PDF';

    public function handle(): int
    {
        $this->info("Installation du module Rapports + PDF");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // RAPPORTS INDEX VIEW
            // =====================================================
            'resources/views/admin/rapports/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Rapports')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg">
            <span class="material-symbols-rounded text-white text-3xl" style="font-variation-settings: 'FILL' 1;">description</span>
        </div>
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">Rapports</h1>
            <p class="text-sm text-slate-500 mt-1">Générez vos rapports et listes au format PDF</p>
        </div>
    </div>

    @php
        $rapports = [
            [
                'icon'  => 'groups',
                'titre' => 'Liste des formateurs',
                'desc'  => 'Exporter la liste complète des formateurs du réseau',
                'route' => route('admin.pdf.formateurs'),
            ],
            [
                'icon'  => 'apartment',
                'titre' => 'Formateurs par établissement',
                'desc'  => 'Liste des formateurs regroupés par établissement',
                'route' => route('admin.pdf.formateurs.par-etablissement'),
            ],
            [
                'icon'  => 'school',
                'titre' => 'Formateurs par filière',
                'desc'  => 'Liste des formateurs regroupés par filière',
                'route' => route('admin.pdf.formateurs.par-filiere'),
            ],
            [
                'icon'  => 'assignment_ind',
                'titre' => 'Affectations',
                'desc'  => 'Liste complète des affectations des formateurs',
                'route' => route('admin.pdf.affectations'),
            ],
            [
                'icon'  => 'monitoring',
                'titre' => 'Statistiques globales',
                'desc'  => 'Tableau de bord chiffré et statistiques complètes',
                'route' => route('admin.pdf.statistiques'),
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
        @foreach($rapports as $r)
            <a href="{{ $r['route'] }}" target="_blank"
               class="bg-white rounded-xl border-2 border-slate-300 p-5 flex flex-col gap-3
                      transition-all hover:border-brand-700 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-lg bg-brand-50 flex items-center justify-center">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">{{ $r['icon'] }}</span>
                </div>
                <div class="flex-1">
                    <div class="font-display font-bold text-slate-900">{{ $r['titre'] }}</div>
                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $r['desc'] }}</p>
                </div>
                <div class="flex items-center gap-1 text-sm font-semibold text-brand-700">
                    Ouvrir le PDF
                    <span class="material-symbols-rounded text-lg group-hover:translate-x-1 transition">arrow_forward</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé — Formateurs</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez la liste avant de générer le PDF</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.formateurs') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les établissements</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les statuts</option>
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer le PDF
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé — Affectations</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez les affectations par statut, établissement ou période</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.affectations') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        <option value="actif">Actif</option>
                        <option value="termine">Terminé</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date début (≥)</label>
                    <input type="date" name="date_debut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection
BLADE,

            // =====================================================
            // ROUTES (mise à jour)
            // =====================================================
            'routes/admin.php' => <<<'PHP'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\EtablissementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PdfController;

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('formateurs', FormateurController::class);
        Route::resource('etablissements', EtablissementController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('affectations', AffectationController::class);

        Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/destroy-all', [NotificationController::class, 'destroyAll'])->name('destroy-all');
        });

        Route::resource('users', UserController::class);

        Route::prefix('pdf')->name('pdf.')->group(function () {
            Route::get('/', [PdfController::class, 'index'])->name('index');
            Route::get('/formateurs', [PdfController::class, 'formateurs'])->name('formateurs');
            Route::get('/formateurs/par-etablissement', [PdfController::class, 'formateursParEtablissement'])->name('formateurs.par-etablissement');
            Route::get('/formateurs/par-filiere', [PdfController::class, 'formateursParFiliere'])->name('formateurs.par-filiere');
            Route::get('/formateurs/{id}', [PdfController::class, 'formateur'])->where('id', '[0-9]+')->name('formateur');
            Route::get('/affectations', [PdfController::class, 'affectations'])->name('affectations');
            Route::get('/statistiques', [PdfController::class, 'statistiques'])->name('statistiques');
        });

        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::get('/formateurs-by-etablissement', [DashboardController::class, 'formateursByEtablissement'])->name('formateurs.by.etablissement');
    });
PHP,
        ];
    }
}
```

## app/Console/Commands/InstallUsers.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallUsers extends Command
{
    protected $signature = 'install:users';
    protected $description = 'Installe le module Comptes admin (CRUD complet en modal)';

    public function handle(): int
    {
        $this->info("Installation du module Comptes admin");
        $this->newLine();

        $files = $this->getFiles();
        $count = 0;

        foreach ($files as $path => $content) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$path} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [

            // =====================================================
            // 1. STORE USER REQUEST
            // =====================================================
            'app/Http/Requests/User/StoreUserRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check() && auth('admin')->user()->role === 'super_admin';
    }

    public function rules(): array
    {
        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.in'            => 'Le rôle doit être : super_admin, admin ou gestionnaire.',
        ];
    }
}
PHP,

            // =====================================================
            // 2. UPDATE USER REQUEST
            // =====================================================
            'app/Http/Requests/User/UpdateUserRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:150', Rule::unique('admins', 'email')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
PHP,

            // =====================================================
            // 3. CONTROLLER (CRUD en AJAX + modal)
            // =====================================================
            'app/Http/Controllers/Admin/UserController.php' => <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index(Request $request)
    {
        $users = AdminModel::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Formulaire de création (AJAX pour modal)
     */
    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form')->render(),
            ]);
        }

        return view('admin.users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        AdminModel::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin créé.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin créé.');
    }

    /**
     * Afficher un utilisateur (AJAX pour modal show)
     */
    public function show(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.show', compact('user'))->render(),
            ]);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Formulaire d'édition (AJAX pour modal)
     */
    public function edit(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form', compact('user'))->render(),
            ]);
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = AdminModel::findOrFail($id);
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin mis à jour.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin mis à jour.');
    }

    /**
     * Supprimer un utilisateur (form classique, pas AJAX)
     */
    public function destroy(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin supprimé.');
    }
}
PHP,

            // =====================================================
            // 4. INDEX VIEW (3 MODALS : Create / Edit / Show)
            // =====================================================
            'resources/views/admin/users/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Utilisateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Utilisateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Comptes administrateurs de l'application</p>
    </div>
    @if(auth('admin')->user()->role === 'super_admin')
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouveau compte
        </button>
    @endif
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher (nom, prénom, email)..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="role" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les rôles</option>
            <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
            <option value="gestionnaire" @selected(request('role') === 'gestionnaire')>Gestionnaire</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Créé le</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm">{{ $user->prenom }} {{ $user->nom }}</div>
                            @if(auth('admin')->id() === $user->id)
                                <div class="text-[10px] text-brand-700 font-semibold">Vous</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="text-sm">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'super_admin')
                        <span class="badge-success">Super Admin</span>
                    @elseif($user->role === 'admin')
                        <span class="badge-info">Admin</span>
                    @else
                        <span class="badge-gray">Gestionnaire</span>
                    @endif
                </td>
                <td class="text-xs text-slate-500">
                    {{ $user->created_at?->format('d/m/Y') }}
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        @if(auth('admin')->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce compte ?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                    <span class="material-symbols-rounded text-lg">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-16 text-slate-400">Aucun utilisateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $users->total() ?? 0 }} utilisateurs</span>
        <div>{{ $users->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouveau compte admin</h2>
                    <p class="text-xs text-slate-500">Créer un nouvel utilisateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier le compte</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeShowModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail utilisateur</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<script>
    console.log('✅ Script users chargé');

    // ========== CREATE ==========
    function openCreateModal() {
        console.log('🔵 CREATE');
        const modal = document.getElementById('createModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch('{{ route("admin.users.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('📦 CREATE chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== EDIT ==========
    function openEditModal(id) {
        console.log('🔵 EDIT', id);
        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('editForm');
        form.action = `/admin/users/${id}`;

        fetch(`/admin/users/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('📦 EDIT chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SHOW ==========
    function openShowModal(id) {
        console.log('🔵 SHOW', id);
        const modal = document.getElementById('showModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch(`/admin/users/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
            console.log('📦 SHOW chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeShowModal() {
        document.getElementById('showModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SOUMISSION AJAX ==========
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('📤 Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('✅ Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('❌', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ========== ESCAPE ==========
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal(); closeEditModal(); closeShowModal();
        }
    });

    // ========== EXPOSER LES FONCTIONS ==========
    window.openCreateModal = openCreateModal;
    window.closeCreateModal = closeCreateModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.openShowModal = openShowModal;
    window.closeShowModal = closeShowModal;
</script>

@endsection
BLADE,

            // =====================================================
            // 5. PARTIAL FORM (Create + Edit)
            // =====================================================
            'resources/views/admin/users/partials/form.blade.php' => <<<'BLADE'
<div class="space-y-5">

    {{-- Identité --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">person</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Identité</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('nom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Prénom <span class="text-red-600">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('prenom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Compte --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">mail</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Compte</h3>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('email') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Mot de passe {{ isset($user) ? '(laisser vide pour ne pas changer)' : '*' }}
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       {{ isset($user) ? '' : 'required' }}>
                @error('password') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Rôle <span class="text-red-600">*</span></label>
                <select name="role" class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100" required>
                    <option value="admin" @selected(old('role', $user->role ?? 'admin') === 'admin')>Admin</option>
                    <option value="gestionnaire" @selected(old('role', $user->role ?? '') === 'gestionnaire')>Gestionnaire</option>
                    <option value="super_admin" @selected(old('role', $user->role ?? '') === 'super_admin')>Super Admin</option>
                </select>
                @error('role') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

</div>
BLADE,

            // =====================================================
            // 6. PARTIAL SHOW
            // =====================================================
            'resources/views/admin/users/partials/show.blade.php' => <<<'BLADE'
<div class="space-y-4">

    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-lg text-slate-900">{{ $user->prenom }} {{ $user->nom }}</div>
                <div class="text-sm text-slate-500">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Rôle</div>
            @if($user->role === 'super_admin')
                <span class="badge-success">Super Admin</span>
            @elseif($user->role === 'admin')
                <span class="badge-info">Admin</span>
            @else
                <span class="badge-gray">Gestionnaire</span>
            @endif
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Créé le</div>
            <div class="font-semibold text-slate-900">{{ $user->created_at?->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

</div>
BLADE,
        ];
    }
}
```

## app/Console/Commands/ProjectInspect.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspect extends Command
{
    protected $signature = 'project:inspect {module}';
    protected $description = 'Inspecte les fichiers d\'un module (existence, taille, champs)';

    public function handle(): int
    {
        $module = $this->argument('module');
        $modules = $this->getModules();

        if (!isset($modules[$module])) {
            $this->error("Module inconnu : {$module}");
            $this->info("Modules disponibles : " . implode(', ', array_keys($modules)));
            return self::FAILURE;
        }

        $this->info("Inspection du module : {$module}");
        $this->newLine();

        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-4s %-12s %-60s %s", 'ST.', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 120));

        foreach ($modules[$module]['files'] as $file) {
            $fullPath = base_path($file['path']);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-4s %-12s %-60s %s o", 'VIDE', $lines, $file['path'], $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-4s %-12s %-60s %s Ko", 'OK', $lines, $file['path'], $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-4s %-12s %-60s %s", 'MANQ', '-', $file['path'], '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Résumé :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        // Vérification des champs pour les vues
        if (isset($modules[$module]['fields'])) {
            $this->newLine();
            $this->info("Vérification des champs :");

            foreach ($modules[$module]['fields'] as $file => $fields) {
                $fullPath = base_path($file);
                if (!File::exists($fullPath)) continue;

                $content = File::get($fullPath);
                $this->newLine();
                $this->line("  Fichier : {$file}");

                foreach ($fields as $field) {
                    $found = str_contains($content, $field);
                    $this->line(sprintf("    %s %s", $found ? 'OK' : 'MANQUE', $field));
                }
            }
        }

        return self::SUCCESS;
    }

    protected function getModules(): array
    {
        return [
            'affectations' => [
                'files' => [
                    ['path' => 'app/Http/Controllers/Admin/AffectationController.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Models/AffectationModel.php'],
                    ['path' => 'app/Domain/Affectations/Entities/Affectation.php'],
                    ['path' => 'app/Application/Affectations/DTOs/CreateAffectationDTO.php'],
                    ['path' => 'app/Application/Affectations/DTOs/UpdateAffectationDTO.php'],
                    ['path' => 'app/Application/Affectations/UseCases/CreateAffectationUseCase.php'],
                    ['path' => 'app/Application/Affectations/UseCases/UpdateAffectationUseCase.php'],
                    ['path' => 'app/Application/Affectations/UseCases/DeleteAffectationUseCase.php'],
                    ['path' => 'app/Http/Requests/Affectation/StoreAffectationRequest.php'],
                    ['path' => 'app/Http/Requests/Affectation/UpdateAffectationRequest.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php'],
                    ['path' => 'resources/views/admin/affectations/index.blade.php'],
                    ['path' => 'resources/views/admin/affectations/create.blade.php'],
                    ['path' => 'resources/views/admin/affectations/edit.blade.php'],
                    ['path' => 'resources/views/admin/affectations/show.blade.php'],
                    ['path' => 'resources/views/admin/affectations/partials/form.blade.php'],
                ],
                'fields' => [
                    'resources/views/admin/affectations/partials/form.blade.php' => [
                        'name="formateur_id"',
                        'name="filiere_id"',
                        'name="etablissement_id"',
                        'name="date_debut"',
                        'name="date_fin"',
                        'name="statut"',
                    ],
                    'resources/views/admin/affectations/index.blade.php' => [
                        'route(\'admin.affectations.show\'',
                        'route(\'admin.formateurs.show\'',
                        '$a->etablissement',
                        'statut',
                    ],
                ],
            ],
            'formateurs' => [
                'files' => [
                    ['path' => 'app/Http/Controllers/Admin/FormateurController.php'],
                    ['path' => 'app/Infrastructure/Persistence/Eloquent/Models/FormateurModel.php'],
                    ['path' => 'app/Domain/Formateurs/Entities/Formateur.php'],
                    ['path' => 'app/Application/Formateurs/DTOs/CreateFormateurDTO.php'],
                    ['path' => 'resources/views/admin/formateurs/index.blade.php'],
                    ['path' => 'resources/views/admin/formateurs/partials/form.blade.php'],
                ],
            ],
        ];
    }
}
```

## app/Console/Commands/ProjectInspectNotifications.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectNotifications extends Command
{
    protected $signature = 'project:inspect-notifications';
    protected $description = 'Inspecte les fichiers du module Notifications';

    public function handle(): int
    {
        $this->info("Inspection du module Notifications");
        $this->newLine();

        $files = $this->getFiles();
        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-6s %-12s %-70s %s", 'STATUT', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 130));

        foreach ($files as $file) {
            $fullPath = base_path($file);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-6s %-12s %-70s %s o", 'VIDE', $lines, $file, $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-6s %-12s %-70s %s Ko", 'OK', $lines, $file, $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-6s %-12s %-70s %s", 'MANQ', '-', $file, '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Résumé :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'app/Http/Controllers/Admin/NotificationController.php',
            'app/Http/Controllers/Admin/DashboardController.php',
            'app/Models/Notification.php',
            'app/Infrastructure/Persistence/Eloquent/Models/NotificationModel.php',
            'app/Application/Notifications/Services/NotificationService.php',
            'resources/views/admin/notifications/index.blade.php',
            'resources/views/layouts/admin.blade.php',
            'routes/admin.php',
            'database/migrations/2026_09_17_122707_create_notifications_table.php',
            'database/migrations/2026_09_17_134108_fix_notifications_table.php',
        ];
    }
}
```

## app/Console/Commands/ProjectInspectRapports.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectRapports extends Command
{
    protected $signature = 'project:inspect-rapports';
    protected $description = 'Inspecte les fichiers du module Rapports/PDF';

    public function handle(): int
    {
        $this->info("Inspection du module Rapports/PDF");
        $this->newLine();

        $files = $this->getFiles();
        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-6s %-12s %-70s %s", 'STATUT', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 130));

        foreach ($files as $file) {
            $fullPath = base_path($file);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-6s %-12s %-70s %s o", 'VIDE', $lines, $file, $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-6s %-12s %-70s %s Ko", 'OK', $lines, $file, $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-6s %-12s %-70s %s", 'MANQ', '-', $file, '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Resume :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'app/Http/Controllers/Admin/PdfController.php',
            'app/Infrastructure/Adapters/Pdf/DompdfExporter.php',
            'app/Infrastructure/Services/PdfExporterInterface.php',
            'resources/views/admin/rapports/index.blade.php',
            'resources/views/pdf/layouts/base.blade.php',
            'resources/views/pdf/formateurs/liste.blade.php',
            'resources/views/pdf/formateurs/fiche.blade.php',
            'resources/views/pdf/formateurs/par-etablissement.blade.php',
            'resources/views/pdf/formateurs/par-filiere.blade.php',
            'resources/views/pdf/affectations/liste.blade.php',
            'resources/views/pdf/statistiques/global.blade.php',
            'routes/admin.php',
        ];
    }
}
```

## app/Console/Commands/ProjectInspectUsers.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInspectUsers extends Command
{
    protected $signature = 'project:inspect-users';
    protected $description = 'Inspecte les fichiers du module Comptes admin';

    public function handle(): int
    {
        $this->info("Inspection du module Comptes admin");
        $this->newLine();

        $files = $this->getFiles();
        $ok = 0;
        $empty = 0;
        $missing = 0;

        $this->line(sprintf("%-6s %-12s %-70s %s", 'STATUT', 'LIGNES', 'CHEMIN', 'TAILLE'));
        $this->line(str_repeat('-', 130));

        foreach ($files as $file) {
            $fullPath = base_path($file);

            if (File::exists($fullPath)) {
                $size = File::size($fullPath);
                $lines = count(file($fullPath));

                if ($size < 10) {
                    $this->line(sprintf("%-6s %-12s %-70s %s o", 'VIDE', $lines, $file, $size));
                    $empty++;
                } else {
                    $sizeKB = round($size / 1024, 1);
                    $this->line(sprintf("%-6s %-12s %-70s %s Ko", 'OK', $lines, $file, $sizeKB));
                    $ok++;
                }
            } else {
                $this->line(sprintf("%-6s %-12s %-70s %s", 'MANQ', '-', $file, '-'));
                $missing++;
            }
        }

        $this->newLine();
        $this->info("Resume :");
        $this->line("  OK       : {$ok}");
        $this->line("  Vides    : {$empty}");
        $this->line("  Manquants: {$missing}");

        return self::SUCCESS;
    }

    protected function getFiles(): array
    {
        return [
            'app/Http/Controllers/Admin/UserController.php',
            'app/Http/Requests/User/StoreUserRequest.php',
            'app/Http/Requests/User/UpdateUserRequest.php',
            'app/Infrastructure/Persistence/Eloquent/Models/AdminModel.php',
            'resources/views/admin/users/index.blade.php',
            'resources/views/admin/users/create.blade.php',
            'resources/views/admin/users/edit.blade.php',
            'resources/views/admin/users/show.blade.php',
            'resources/views/admin/users/partials/form.blade.php',
            'database/migrations/2024_01_01_000001_create_admins_table.php',
            'routes/admin.php',
        ];
    }
}
```

## app/Console/Commands/ProjectInstall.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProjectInstall extends Command
{
    protected $signature = 'project:install {module}';

    protected $description = 'Installe les fichiers d\'un module (formateurs, etablissements, filieres...)';

    public function handle(): int
    {
        $module = $this->argument('module');
        $modules = $this->getModules();

        if (!isset($modules[$module])) {
            $this->error("Module inconnu : {$module}");
            $this->info("Modules disponibles : " . implode(', ', array_keys($modules)));
            return self::FAILURE;
        }

        $this->info("Installation du module : {$module}");
        $this->newLine();

        $count = 0;
        foreach ($modules[$module] as $relativePath => $content) {
            $fullPath = base_path($relativePath);
            $directory = dirname($fullPath);

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            File::put($fullPath, $content);
            $size = strlen($content);
            $this->line("  OK  {$relativePath} ({$size} car.)");
            $count++;
        }

        $this->newLine();
        $this->info("Nettoyage des caches...");
        $this->call('optimize:clear');

        $this->newLine();
        $this->info("SUCCES : {$count} fichier(s) installe(s) !");
        return self::SUCCESS;
    }

    protected function getModules(): array
    {
        return [
            'formateurs' => $this->getFormateursFiles(),
        ];
    }

    // ============================================================
    // MODULE FORMATEURS
    // ============================================================
    protected function getFormateursFiles(): array
    {
        return [

            // =====================================================
            // 1. CONTROLLER
            // =====================================================
            'app/Http/Controllers/Admin/FormateurController.php' => <<<'PHP'
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formateur\StoreFormateurRequest;
use App\Http\Requests\Formateur\UpdateFormateurRequest;
use Application\Formateurs\DTOs\CreateFormateurDTO;
use Application\Formateurs\DTOs\UpdateFormateurDTO;
use Application\Formateurs\UseCases\CreateFormateur\CreateFormateurUseCase;
use Application\Formateurs\UseCases\DeleteFormateur\DeleteFormateurUseCase;
use Application\Formateurs\UseCases\UpdateFormateur\UpdateFormateurUseCase;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurController extends Controller
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
        private CreateFormateurUseCase $createUseCase,
        private UpdateFormateurUseCase $updateUseCase,
        private DeleteFormateurUseCase $deleteUseCase,
    ) {}

    public function index()
    {
        $formateurs = FormateurModel::with(['etablissement', 'filiere'])
            ->search(request('search'))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('filiere_id'), fn($q, $id) => $q->where('filiere_id', $id))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(15)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.index', compact('formateurs', 'etablissements', 'filieres'));
    }

    public function create()
    {
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $nextMatricule = FormateurModel::generateNextMatricule();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.formateurs.partials.form', compact(
                    'etablissements', 'filieres', 'nextMatricule'
                ))->render(),
                'matricule' => $nextMatricule,
            ]);
        }

        return view('admin.formateurs.create', compact('etablissements', 'filieres', 'nextMatricule'));
    }

    public function store(StoreFormateurRequest $request)
    {
        try {
            $dto = CreateFormateurDTO::fromArray($request->validated());
            $this->createUseCase->execute($dto);

            $model = FormateurModel::where('matricule', $request->matricule)->first();
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'  => true,
                    'message'  => 'Formateur cree avec succes.',
                    'redirect' => route('admin.formateurs.index'),
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur cree avec succes.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(int $id)
    {
        $formateur = FormateurModel::with([
            'etablissement', 'filiere',
            'affectations.filiere', 'affectations.etablissement',
            'sessions.filiere', 'sessions.etablissement',
        ])->findOrFail($id);

        $stats = [
            'affectations_total'   => $formateur->affectations->count(),
            'affectations_actives' => $formateur->affectations->where('statut', 'actif')->count(),
            'sessions_total'       => $formateur->sessions->count(),
            'filieres_total'       => $formateur->filiere ? 1 : 0,
        ];

        return view('admin.formateurs.show', compact('formateur', 'stats'));
    }

    public function edit(int $id)
    {
        $formateur = FormateurModel::findOrFail($id);
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.edit', compact('formateur', 'etablissements', 'filieres'));
    }

    public function update(UpdateFormateurRequest $request, int $id)
    {
        try {
            $dto = UpdateFormateurDTO::fromArray($id, $request->validated());
            $this->updateUseCase->execute($dto);

            $model = FormateurModel::find($id);
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur mis a jour.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteUseCase->execute($id);
            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur supprime.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
PHP,

            // =====================================================
            // 2. STORE REQUEST
            // =====================================================
            'app/Http/Requests/Formateur/StoreFormateurRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'matricule'        => ['required', 'string', 'max:50', 'unique:formateurs,matricule', 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', 'unique:formateurs,email'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.regex'  => 'Le matricule doit suivre le format FORM-XXX.',
            'matricule.unique' => 'Ce matricule est deja utilise.',
            'email.unique'     => 'Cet email est deja utilise.',
            'statut.in'        => 'Le statut doit etre : actif, inactif ou suspendu.',
        ];
    }
}
PHP,

            // =====================================================
            // 3. UPDATE REQUEST
            // =====================================================
            'app/Http/Requests/Formateur/UpdateFormateurRequest.php' => <<<'PHP'
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('formateur');

        return [
            'matricule'        => ['required', 'string', 'max:50', Rule::unique('formateurs', 'matricule')->ignore($id), 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', Rule::unique('formateurs', 'email')->ignore($id)],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }
}
PHP,

            // =====================================================
            // 4. FORM PARTIAL (CADRES VISIBLES)
            // =====================================================
            'resources/views/admin/formateurs/partials/form.blade.php' => <<<'BLADE'
@php
    $grades = [
        'Assistant', 'Assistant Principal', 'Maitre-Assistant',
        'Maitre de Conferences', 'Professeur Habilité',
        'Professeur de l\'Enseignement Supérieur', 'Professeur Titulaire',
        'Vacataire', 'Contractuel',
    ];
@endphp

<style>
    .form-field { width:100%; padding:0.75rem 1rem; font-size:0.9375rem; line-height:1.5; color:#0f172a; background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s ease; font-family:inherit; }
    .form-field::placeholder { color:#94a3b8; }
    .form-field:focus { outline:none; border-color:#059669; box-shadow:0 0 0 3px rgba(5,150,105,0.12); }
    .form-field:read-only, .form-field:disabled { background-color:#f8fafc; color:#64748b; cursor:not-allowed; }
    .form-label { display:block; font-size:0.875rem; font-weight:600; color:#1e293b; margin-bottom:0.375rem; }
    .form-label .required { color:#ef4444; margin-left:0.125rem; }
    .form-hint { font-size:0.75rem; color:#64748b; margin-top:0.375rem; }
    .form-card { background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.75rem; padding:1.25rem; }
    .form-card + .form-card { margin-top:1rem; }
    .form-card-header { display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px dashed #e2e8f0; }
    .form-card-icon { width:1.75rem; height:1.75rem; display:inline-flex; align-items:center; justify-content:center; background:#d1fae5; color:#059669; border-radius:0.5rem; font-size:1.125rem; }
    .form-card-title { font-size:0.8125rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:0.05em; }
    .form-error { font-size:0.75rem; color:#ef4444; margin-top:0.25rem; }
</style>

<div class="space-y-4">

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">badge</span>
            <span class="form-card-title">Identité</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Matricule <span class="required">*</span> <span class="text-xs font-normal text-emerald-600 ml-1">(auto-généré)</span></label>
                <input type="text" name="matricule" value="{{ old('matricule', $formateur->matricule ?? ($nextMatricule ?? '')) }}" class="form-field font-mono" readonly required>
                @error('matricule') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $formateur->nom ?? '') }}" class="form-field" placeholder="Ex: RAKOTO" required>
                @error('nom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Prénom <span class="required">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom ?? '') }}" class="form-field" placeholder="Ex: Jean" required>
                @error('prenom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-field">
                    <option value="">— Sélectionner —</option>
                    <option value="Masculin" @selected(old('sexe', $formateur->sexe ?? '') === 'Masculin')>Masculin</option>
                    <option value="Feminin" @selected(old('sexe', $formateur->sexe ?? '') === 'Feminin')>Féminin</option>
                </select>
            </div>
            <div>
                <label class="form-label">CIN</label>
                <input type="text" name="cin" value="{{ old('cin', $formateur->cin ?? '') }}" class="form-field" placeholder="Ex: 101234567890">
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($formateur) && $formateur->date_naissance ? $formateur->date_naissance->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">toggle_on</span>
            <span class="form-card-title">Statut global</span>
        </div>
        <div>
            <label class="form-label">Statut <span class="required">*</span></label>
            <select name="statut" class="form-field" required>
                <option value="actif" @selected(old('statut', $formateur->statut ?? 'actif') === 'actif')>Actif — Le formateur est en activité</option>
                <option value="inactif" @selected(old('statut', $formateur->statut ?? '') === 'inactif')>Inactif — Le formateur a terminé</option>
                <option value="suspendu" @selected(old('statut', $formateur->statut ?? '') === 'suspendu')>Suspendu — Le formateur est en pause</option>
            </select>
            <p class="form-hint">Ce statut sera appliqué au formateur, ses affectations, sessions, établissement et filière</p>
            @error('statut') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">link</span>
            <span class="form-card-title">Affectation</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Établissement</label>
                <select name="etablissement_id" class="form-field">
                    <option value="">— Aucun —</option>
                    @foreach($etablissements ?? [] as $etablissement)
                        <option value="{{ $etablissement->id }}" @selected(old('etablissement_id', $formateur->etablissement_id ?? '') == $etablissement->id)>{{ $etablissement->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Filière</label>
                <select name="filiere_id" class="form-field">
                    <option value="">— Aucune —</option>
                    @foreach($filieres ?? [] as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id', $formateur->filiere_id ?? '') == $filiere->id)>{{ $filiere->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Grade <span class="required">*</span></label>
                <select name="grade" class="form-field" required>
                    <option value="">— Sélectionner —</option>
                    @foreach($grades as $g)
                        <option value="{{ $g }}" @selected(old('grade', $formateur->grade ?? '') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('grade') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Date de recrutement</label>
                <input type="date" name="date_recrutement" value="{{ old('date_recrutement', isset($formateur) && $formateur->date_recrutement ? $formateur->date_recrutement->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">contact_mail</span>
            <span class="form-card-title">Coordonnées</span>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email', $formateur->email ?? '') }}" class="form-field" placeholder="Ex: jean.rakoto@example.com" required>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone ?? '') }}" class="form-field" placeholder="Ex: 034 12 345 67">
            </div>
            <div>
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse', $formateur->adresse ?? '') }}" class="form-field" placeholder="Ex: Lot II M 45 Bis, Antananarivo">
            </div>
        </div>
    </div>

</div>
BLADE,

            // =====================================================
            // 5. CREATE VIEW
            // =====================================================
            'resources/views/admin/formateurs/create.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Nouveau formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Ajouter un formateur</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>
@endsection
BLADE,

            // =====================================================
            // 6. EDIT VIEW
            // =====================================================
            'resources/views/admin/formateurs/edit.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Modifier formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Modifier : {{ $formateur->nom }} {{ $formateur->prenom }}</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.update', $formateur->id) }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @method('PUT')
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Mettre à jour
        </button>
    </div>
</form>
@endsection
BLADE,

            // =====================================================
            // 7. INDEX VIEW (MODAL Z-INDEX MAX + SCROLL Y)
            // =====================================================
            'resources/views/admin/formateurs/index.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Formateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Formateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Liste de tous les formateurs du réseau</p>
    </div>
    <button type="button" onclick="openFormateurModal()" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter un formateur
    </button>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un formateur..." class="form-input pl-10">
        </div>
        <select name="etablissement_id" class="form-input">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Filière</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateurs ?? [] as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}" class="hover:text-brand-700">{{ $f->nom }} {{ $f->prenom }}</a>
                </td>
                <td>{{ $f->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $f->filiere->libelle ?? '—' }}</td>
                <td>
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.formateurs.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucun formateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $formateurs->total() ?? 0 }} formateurs</span>
        <div>{{ $formateurs->links() }}</div>
    </div>
</div>

{{-- ========== MODAL AJOUTER (z-index MAX) ========== --}}
<div id="formateurModal"
     style="display: none; position: fixed !important; inset: 0 !important; z-index: 2147483647 !important; align-items: center; justify-content: center; padding: 1rem;"
     onclick="if(event.target === this) closeFormateurModal()">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" style="z-index: 1;"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
         style="z-index: 2; max-height: calc(100vh - 2rem);">

        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-md">
                    <span class="material-symbols-rounded text-white text-xl" style="font-variation-settings: 'FILL' 1;">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Ajouter un formateur</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Le statut sera propagé à toutes les tables liées</p>
                </div>
            </div>
            <button type="button" onclick="closeFormateurModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        <form id="formateurForm" method="POST" action="{{ route('admin.formateurs.store') }}"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div id="formateurFormContent"
                 class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden px-6 py-5">
                <div class="text-center py-16 text-slate-400">
                    <span class="material-symbols-rounded text-4xl animate-spin block mb-3">progress_activity</span>
                    <p class="text-sm">Chargement du formulaire...</p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeFormateurModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="material-symbols-rounded text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ===== MODAL AU-DESSUS DE TOUT ===== */
    #formateurModal:not(.hidden) {
        display: flex !important;
    }

    #formateurModal > .absolute {
        z-index: 1 !important;
    }

    #formateurModal > .relative {
        z-index: 2 !important;
        position: relative;
    }

    #formateurForm {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
        overflow: hidden;
    }

    #formateurFormContent {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    #formateurFormContent::-webkit-scrollbar { width: 8px; }
    #formateurFormContent::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ===== BLOQUER TOUT LE RESTE ===== */
    body.modal-open {
        overflow: hidden !important;
    }

    body.modal-open > *:not(#formateurModal) {
        pointer-events: none !important;
        user-select: none !important;
    }

    body.modal-open #formateurModal,
    body.modal-open #formateurModal * {
        pointer-events: auto !important;
        user-select: auto !important;
    }
</style>

<script>
    let savedScrollPosition = 0;

    function openFormateurModal() {
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        savedScrollPosition = window.scrollY || document.documentElement.scrollTop;

        modal.style.display = 'flex';
        modal.classList.remove('hidden');

        document.body.classList.add('modal-open');
        document.body.style.position = 'fixed';
        document.body.style.top = `-${savedScrollPosition}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';

        fetch('{{ route("admin.formateurs.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('formateurFormContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error(err);
            document.getElementById('formateurFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeFormateurModal() {
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.style.display = 'none';

        document.body.classList.remove('modal-open');
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';

        window.scrollTo(0, savedScrollPosition);
    }

    document.getElementById('formateurForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-[18px] animate-spin">progress_activity</span> Enregistrement...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            alert('Erreur lors de l\'enregistrement : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const modal = document.getElementById('formateurModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeFormateurModal();
            }
        }
    });
</script>

@endsection
BLADE,

            // =====================================================
            // 8. SHOW VIEW
            // =====================================================
            'resources/views/admin/formateurs/show.blade.php' => <<<'BLADE'
@extends('layouts.admin')
@section('title', 'Fiche formateur')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-700 flex items-center justify-center shrink-0">
            <span class="text-white text-3xl font-bold">
                {{ strtoupper(substr($formateur->prenom ?? 'U', 0, 1) . substr($formateur->nom ?? 'N', 0, 1)) }}
            </span>
        </div>
        <div class="flex-1">
            <h1 class="font-display text-2xl font-bold text-slate-900">{{ $formateur->nom }} {{ $formateur->prenom }}</h1>
            <div class="text-[13px] text-slate-500 mt-2 flex flex-wrap gap-4">
                <span>Matricule : <span class="font-mono">{{ $formateur->matricule }}</span></span>
                @if($formateur->grade)
                    <span>Grade : {{ $formateur->grade }}</span>
                @endif
            </div>
        </div>
        <div>
            @if($formateur->statut === 'actif')
                <span class="badge-success">Actif</span>
            @elseif($formateur->statut === 'suspendu')
                <span class="badge-warning">Suspendu</span>
            @else
                <span class="badge-danger">Inactif</span>
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Informations</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Email :</span> {{ $formateur->email ?? '—' }}</div>
            <div><span class="text-slate-500">Téléphone :</span> {{ $formateur->telephone ?? '—' }}</div>
            <div><span class="text-slate-500">Grade :</span> {{ $formateur->grade ?? '—' }}</div>
            <div><span class="text-slate-500">CIN :</span> {{ $formateur->cin ?? '—' }}</div>
            <div><span class="text-slate-500">Sexe :</span> {{ $formateur->sexe ?? '—' }}</div>
            <div><span class="text-slate-500">Date naissance :</span> {{ $formateur->date_naissance?->format('d/m/Y') ?? '—' }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Filière</h2>
        @if($formateur->filiere)
            <a href="{{ route('admin.filieres.show', $formateur->filiere->id) }}" class="block p-3 rounded-lg bg-slate-50 hover:bg-brand-50">
                {{ $formateur->filiere->libelle }}
            </a>
        @else
            <p class="text-slate-400 text-sm">Aucune filière</p>
        @endif
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b">
        <h2 class="font-bold text-slate-900">Affectations ({{ $formateur->affectations->count() }})</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateur->affectations as $a)
            <tr>
                <td>{{ $a->filiere->libelle ?? '—' }}</td>
                <td>{{ $a->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} → {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-gray">Inactif</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-8 text-slate-400">Aucune affectation</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
BLADE,
        ];
    }
}
```

## app/Domain/Affectations/Entities/Affectation.php

```php
<?php

namespace Domain\Affectations\Entities;

use Carbon\Carbon;

class Affectation
{
    public function __construct(
        public ?int $id,
        public int $formateurId,
        public int $filiereId,
        public int $etablissementId,
        public Carbon $dateDebut,
        public ?Carbon $dateFin = null,
        public string $statut = 'actif',
    ) {}

    public function estActive(): bool
    {
        return $this->statut === 'actif';
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'termine';
    }

    public function estSuspendue(): bool
    {
        return $this->statut === 'suspendu';
    }

    public function getDureeEnJours(): int
    {
        if (!$this->dateFin) {
            return 0;
        }
        return $this->dateDebut->diffInDays($this->dateFin);
    }
}
```

## app/Domain/Affectations/Exceptions/AffectationConflictException.php

```php

```

## app/Domain/Affectations/Ports/AffectationRepositoryInterface.php

```php

```

## app/Domain/Affectations/Rules/AffectationRules.php

```php

```

## app/Domain/Affectations/ValueObjects/DateAffectation.php

```php

```

## app/Domain/Affectations/ValueObjects/StatutAffectation.php

```php

```

## app/Domain/Auth/Entities/Admin.php

```php
<?php

namespace Domain\Auth\Entities;

class Admin
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $password = null,
        public string $role = 'admin',
        public ?string $avatar = null,
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function estGestionnaire(): bool
    {
        return $this->role === 'gestionnaire';
    }
}
```

## app/Domain/Auth/Entities/FormateurUser.php

```php
<?php

namespace Domain\Auth\Entities;

class FormateurUser
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public string $matricule,
        public ?string $password = null,
        public ?string $telephone = null,
        public ?int $etablissementId = null,
        public string $statut = 'en_attente',
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estActif(): bool
    {
        return $this->statut === 'actif';
    }

    public function estEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }
}
```

## app/Domain/Auth/Entities/User.php

```php
<?php

namespace Domain\Auth\Entities;

class User
{
    public function __construct(
        public ?int $id,
        public string $nom,
        public string $prenom,
        public string $email,
        public ?string $password = null,
        public string $role = 'user',
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'super_admin';
    }
}
```

## app/Domain/Auth/Exceptions/InvalidCredentialsException.php

```php

```

## app/Domain/Auth/Exceptions/UnauthorizedException.php

```php

```

## app/Domain/Auth/Exceptions/UserAlreadyExistsException.php

```php

```

## app/Domain/Auth/Ports/AdminRepositoryInterface.php

```php

```

## app/Domain/Auth/Ports/FormateurUserRepositoryInterface.php

```php

```

## app/Domain/Auth/Ports/PasswordHasherInterface.php

```php
<?php

namespace Domain\Auth\Ports;

interface PasswordHasherInterface
{
    public function hash(string $plainPassword): string;
    public function verify(string $plainPassword, string $hashedPassword): bool;
}
```

## app/Domain/Auth/Ports/TokenGeneratorInterface.php

```php

```

## app/Domain/Auth/Ports/UserRepositoryInterface.php

```php

```

## app/Domain/Auth/Rules/AuthRules.php

```php

```

## app/Domain/Auth/Rules/EmailRules.php

```php

```

## app/Domain/Auth/Rules/PasswordRules.php

```php

```

## app/Domain/Auth/ValueObjects/Email.php

```php

```

## app/Domain/Auth/ValueObjects/Password.php

```php

```

## app/Domain/Auth/ValueObjects/Role.php

```php

```

## app/Domain/Etablissements/Entities/Etablissement.php

```php
<?php

namespace Domain\Etablissements\Entities;

class Etablissement
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $nom,
        public string $type = 'CFP',
        public ?string $region = null,
        public ?string $adresse = null,
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom;
    }

    public function estCFP(): bool
    {
        return $this->type === 'CFP';
    }

    public function estLTP(): bool
    {
        return $this->type === 'LTP';
    }

    public function estLycee(): bool
    {
        return $this->type === 'Lycee';
    }
}
```

## app/Domain/Etablissements/Exceptions/EtablissementNotFoundException.php

```php

```

## app/Domain/Etablissements/Ports/EtablissementRepositoryInterface.php

```php

```

## app/Domain/Etablissements/Rules/EtablissementRules.php

```php

```

## app/Domain/Etablissements/ValueObjects/Adresse.php

```php

```

## app/Domain/Etablissements/ValueObjects/CodeEtablissement.php

```php

```

## app/Domain/Etablissements/ValueObjects/TypeEtablissement.php

```php

```

## app/Domain/Filieres/Entities/Filiere.php

```php
<?php

namespace Domain\Filieres\Entities;

class Filiere
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
        public ?int $niveauId = null,
        public ?int $secteurId = null,
        public ?string $description = null,
        public array $options = [],
    ) {}

    public function getLibelleComplet(): string
    {
        return $this->libelle;
    }

    public function aDesOptions(): bool
    {
        return count($this->options) > 0;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
```

## app/Domain/Filieres/Exceptions/FiliereNotFoundException.php

```php

```

## app/Domain/Filieres/Ports/FiliereRepositoryInterface.php

```php

```

## app/Domain/Filieres/Rules/FiliereRules.php

```php

```

## app/Domain/Filieres/ValueObjects/CodeFiliere.php

```php

```

## app/Domain/Filieres/ValueObjects/LibelleFiliere.php

```php

```

## app/Domain/Formateurs/Entities/Formateur.php

```php
<?php

namespace Domain\Formateurs\Entities;

class Formateur
{
    public function __construct(
        public ?int $id = null,
        public string $matricule = '',
        public string $nom = '',
        public string $prenom = '',
        public string $email = '',
        public ?string $telephone = null,
        public ?string $sexe = null,
        public ?string $date_naissance = null,
        public ?string $lieu_naissance = null,
        public ?string $cin = null,
        public ?string $adresse = null,
        public ?string $grade = null,
        public ?string $date_recrutement = null,
        public ?string $photo = null,
        public ?int $etablissement_id = null,
        public ?int $filiere_id = null,
        public string $statut = 'actif',
    ) {}

    public function getNomComplet(): string
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function estActif(): bool
    {
        return $this->statut === 'actif';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id:               $data['id'] ?? null,
            matricule:        $data['matricule'],
            nom:              $data['nom'],
            prenom:           $data['prenom'],
            email:            $data['email'],
            telephone:        $data['telephone'] ?? null,
            sexe:             $data['sexe'] ?? null,
            date_naissance:   $data['date_naissance'] ?? null,
            lieu_naissance:   $data['lieu_naissance'] ?? null,
            cin:              $data['cin'] ?? null,
            adresse:          $data['adresse'] ?? null,
            grade:            $data['grade'] ?? null,
            date_recrutement: $data['date_recrutement'] ?? null,
            photo:            $data['photo'] ?? null,
            etablissement_id: $data['etablissement_id'] ?? null,
            filiere_id:       $data['filiere_id'] ?? null,
            statut:           $data['statut'] ?? 'actif',
        );
    }

    public function toArray(): array
    {
        return [
            'matricule'        => $this->matricule,
            'nom'              => $this->nom,
            'prenom'           => $this->prenom,
            'email'            => $this->email,
            'telephone'        => $this->telephone,
            'sexe'             => $this->sexe,
            'date_naissance'   => $this->date_naissance,
            'lieu_naissance'   => $this->lieu_naissance,
            'cin'              => $this->cin,
            'adresse'          => $this->adresse,
            'grade'            => $this->grade,
            'date_recrutement' => $this->date_recrutement,
            'photo'            => $this->photo,
            'etablissement_id' => $this->etablissement_id,
            'filiere_id'       => $this->filiere_id,
            'statut'           => $this->statut,
        ];
    }
}
```

## app/Domain/Formateurs/Exceptions/FormateurDejaExistantException.php

```php
<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurDejaExistantException extends Exception
{
    public static function withMatricule(string $matricule): self
    {
        return new self("Un formateur avec le matricule {$matricule} existe déjà.");
    }
}
```

## app/Domain/Formateurs/Exceptions/FormateurInvalideException.php

```php
<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurInvalideException extends Exception
{
    public static function emailInvalide(string $email): self
    {
        return new self("L'email '{$email}' n'est pas valide.");
    }

    public static function matriculeInvalide(string $matricule): self
    {
        return new self(
            "Le matricule '{$matricule}' n'est pas valide. Format attendu : FORM-XXX."
        );
    }

    public static function nomVide(): self
    {
        return new self("Le nom ne peut pas être vide.");
    }

    public static function prenomVide(): self
    {
        return new self("Le prénom ne peut pas être vide.");
    }

    public static function telephoneInvalide(string $telephone): self
    {
        return new self("Le numéro de téléphone '{$telephone}' n'est pas valide.");
    }
}
```

## app/Domain/Formateurs/Exceptions/FormateurNotFoundException.php

```php
<?php

namespace Domain\Formateurs\Exceptions;

use Exception;

class FormateurNotFoundException extends Exception
{
    public static function withId(int $id): self
    {
        return new self("Formateur avec ID {$id} introuvable.");
    }

    public static function withMatricule(string $matricule): self
    {
        return new self("Formateur avec matricule '{$matricule}' introuvable.");
    }
}
```

## app/Domain/Formateurs/Ports/FormateurRepositoryInterface.php

```php
<?php

namespace Domain\Formateurs\Ports;

use Domain\Formateurs\Entities\Formateur;

interface FormateurRepositoryInterface
{
    public function save(Formateur $formateur): Formateur;
    public function findById(int $id): ?Formateur;
    public function findByMatricule(string $matricule): ?Formateur;
    public function findAll(): array;
    public function delete(int $id): void;
}
```

## app/Domain/Formateurs/Rules/FormateurRules.php

```php
<?php

namespace Domain\Formateurs\Rules;

class FormateurRules
{
    /**
     * Matricule : FORM-XXX (au moins 3 chiffres)
     */
    public static function validerMatricule(string $matricule): bool
    {
        return preg_match('/^FORM-\d{3,}$/', $matricule) === 1;
    }

    public static function validerEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validerStatut(string $statut): bool
    {
        return in_array($statut, ['actif', 'inactif', 'en_attente'], true);
    }

    public static function validerTelephone(?string $telephone): bool
    {
        if ($telephone === null || $telephone === '') {
            return true; // Optionnel
        }

        $cleaned = preg_replace('/[^0-9+]/', '', $telephone);

        return strlen($cleaned) >= 7 && strlen($cleaned) <= 20;
    }

    public static function validerNom(string $nom): bool
    {
        return !empty(trim($nom)) && strlen($nom) <= 100;
    }

    public static function validerPrenom(string $prenom): bool
    {
        return !empty(trim($prenom)) && strlen($prenom) <= 100;
    }

    public static function validerSexe(?string $sexe): bool
    {
        if ($sexe === null || $sexe === '') {
            return true;
        }

        return in_array($sexe, ['Masculin', 'Feminin'], true);
    }

    /**
     * Validation complète d'un tableau de données formateur
     *
     * @return array Tableau d'erreurs (vide si tout OK)
     */
    public static function valider(array $data): array
    {
        $erreurs = [];

        if (isset($data['matricule']) && !self::validerMatricule($data['matricule'])) {
            $erreurs['matricule'] = "Le matricule doit suivre le format FORM-XXX.";
        }

        if (isset($data['email']) && !self::validerEmail($data['email'])) {
            $erreurs['email'] = "L'email n'est pas valide.";
        }

        if (isset($data['nom']) && !self::validerNom($data['nom'])) {
            $erreurs['nom'] = "Le nom est obligatoire (max 100 caractères).";
        }

        if (isset($data['prenom']) && !self::validerPrenom($data['prenom'])) {
            $erreurs['prenom'] = "Le prénom est obligatoire (max 100 caractères).";
        }

        if (isset($data['telephone']) && !self::validerTelephone($data['telephone'])) {
            $erreurs['telephone'] = "Le téléphone n'est pas valide.";
        }

        if (isset($data['statut']) && !self::validerStatut($data['statut'])) {
            $erreurs['statut'] = "Le statut n'est pas valide.";
        }

        if (isset($data['sexe']) && !self::validerSexe($data['sexe'])) {
            $erreurs['sexe'] = "Le sexe n'est pas valide.";
        }

        return $erreurs;
    }
}
```

## app/Domain/Formateurs/ValueObjects/Email.php

```php
<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim(strtolower($value));

        if (empty($value)) {
            throw new InvalidArgumentException("L'email ne peut pas être vide.");
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("L'email '{$value}' n'est pas valide.");
        }

        if (strlen($value) > 255) {
            throw new InvalidArgumentException("L'email ne peut pas dépasser 255 caractères.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDomain(): string
    {
        return substr(strrchr($this->value, "@"), 1);
    }

    public function equals(Email $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
```

## app/Domain/Formateurs/ValueObjects/Matricule.php

```php
<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Matricule
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException("Le matricule ne peut pas être vide.");
        }
        if (strlen($value) > 50) {
            throw new InvalidArgumentException("Le matricule ne peut pas dépasser 50 caractères.");
        }
        $this->value = strtoupper(trim($value));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Matricule $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
```

## app/Domain/Formateurs/ValueObjects/NomComplet.php

```php
<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class NomComplet
{
    private string $nom;
    private string $prenom;

    public function __construct(string $nom, string $prenom)
    {
        $nom = trim($nom);
        $prenom = trim($prenom);

        if (empty($nom)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }

        if (empty($prenom)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }

        if (strlen($nom) > 100) {
            throw new InvalidArgumentException("Le nom ne peut pas dépasser 100 caractères.");
        }

        if (strlen($prenom) > 100) {
            throw new InvalidArgumentException("Le prénom ne peut pas dépasser 100 caractères.");
        }

        $this->nom = ucfirst(strtolower($nom));
        $this->prenom = ucfirst(strtolower($prenom));
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Format : "Prénom Nom" (convention Madagascar)
     */
    public function getFormatted(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Format : "NOM Prénom"
     */
    public function getFormattedAvecNomMajuscule(): string
    {
        return strtoupper($this->nom) . ' ' . $this->prenom;
    }

    public function getInitiales(): string
    {
        return strtoupper(substr($this->prenom, 0, 1) . substr($this->nom, 0, 1));
    }

    public function equals(NomComplet $other): bool
    {
        return $this->nom === $other->nom && $this->prenom === $other->prenom;
    }

    public function __toString(): string
    {
        return $this->getFormatted();
    }
}
```

## app/Domain/Formateurs/ValueObjects/Statut.php

```php
<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Statut
{
    public const ACTIF = 'actif';
    public const INACTIF = 'inactif';
    public const EN_ATTENTE = 'en_attente';

    private const STATUTS_VALIDES = [
        self::ACTIF,
        self::INACTIF,
        self::EN_ATTENTE,
    ];

    private string $value;

    public function __construct(string $value)
    {
        $value = strtolower(trim($value));

        if (!in_array($value, self::STATUTS_VALIDES, true)) {
            throw new InvalidArgumentException(
                "Le statut '{$value}' n'est pas valide. Valeurs autorisées : "
                . implode(', ', self::STATUTS_VALIDES)
            );
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function estActif(): bool
    {
        return $this->value === self::ACTIF;
    }

    public function estInactif(): bool
    {
        return $this->value === self::INACTIF;
    }

    public function estEnAttente(): bool
    {
        return $this->value === self::EN_ATTENTE;
    }

    public function getLabel(): string
    {
        return match ($this->value) {
            self::ACTIF => 'Actif',
            self::INACTIF => 'Inactif',
            self::EN_ATTENTE => 'En attente',
            default => 'Inconnu',
        };
    }

    public static function actif(): self
    {
        return new self(self::ACTIF);
    }

    public static function inactif(): self
    {
        return new self(self::INACTIF);
    }

    public static function enAttente(): self
    {
        return new self(self::EN_ATTENTE);
    }

    public function equals(Statut $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
```

## app/Domain/Formateurs/ValueObjects/Telephone.php

```php
<?php

namespace Domain\Formateurs\ValueObjects;

use InvalidArgumentException;

class Telephone
{
    private ?string $value;

    public function __construct(?string $value)
    {
        if ($value === null || trim($value) === '') {
            $this->value = null;
            return;
        }

        // Nettoyer : garder uniquement les chiffres et le +
        $cleaned = preg_replace('/[^0-9+]/', '', $value);

        if (empty($cleaned)) {
            throw new InvalidArgumentException("Le numéro de téléphone est invalide.");
        }

        if (strlen($cleaned) < 7 || strlen($cleaned) > 20) {
            throw new InvalidArgumentException(
                "Le numéro de téléphone doit contenir entre 7 et 20 caractères."
            );
        }

        $this->value = $cleaned;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function isNull(): bool
    {
        return $this->value === null;
    }

    /**
     * Format pour affichage : 034 12 345 67
     */
    public function getFormatted(): ?string
    {
        if ($this->value === null) {
            return null;
        }

        // Format Madagascar : 0341234567 → 034 12 345 67
        if (strlen($this->value) === 10 && $this->value[0] === '0') {
            return substr($this->value, 0, 3) . ' '
                . substr($this->value, 3, 2) . ' '
                . substr($this->value, 5, 3) . ' '
                . substr($this->value, 8, 2);
        }

        return $this->value;
    }

    public function equals(Telephone $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value ?? '';
    }
}
```

## app/Domain/Niveaux/Entities/Niveau.php

```php
<?php

namespace Domain\Niveaux\Entities;

class Niveau
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
        public ?string $description = null,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function estBac(): bool
    {
        return $this->code === 'BAC';
    }

    public function estBep(): bool
    {
        return $this->code === 'BEP';
    }

    public function estCap(): bool
    {
        return $this->code === 'CAP';
    }

    public function estCfa(): bool
    {
        return $this->code === 'CFA';
    }

    public function estCaps(): bool
    {
        return $this->code === 'CAPS';
    }
}
```

## app/Domain/Niveaux/Ports/NiveauRepositoryInterface.php

```php

```

## app/Domain/Niveaux/Rules/NiveauRules.php

```php

```

## app/Domain/Niveaux/ValueObjects/CodeNiveau.php

```php

```

## app/Domain/Secteurs/Entities/Secteur.php

```php
<?php

namespace Domain\Secteurs\Entities;

class Secteur
{
    public function __construct(
        public ?int $id,
        public string $code,
        public string $libelle,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function estIndustriel(): bool
    {
        return $this->code === 'IND';
    }

    public function estGenieCivil(): bool
    {
        return $this->code === 'GC';
    }

    public function estTertiaire(): bool
    {
        return $this->code === 'TER';
    }

    public function estAgricole(): bool
    {
        return $this->code === 'AGR';
    }

    public function estTourisme(): bool
    {
        return $this->code === 'THR';
    }

    public function estTha(): bool
    {
        return $this->code === 'THA';
    }

    public function estTic(): bool
    {
        return $this->code === 'TIC';
    }
}
```

## app/Domain/Secteurs/Ports/SecteurRepositoryInterface.php

```php

```

## app/Domain/Secteurs/Rules/SecteurRules.php

```php

```

## app/Domain/Secteurs/ValueObjects/CodeSecteur.php

```php

```

## app/Domain/Sessions/Entities/Session.php

```php
<?php

namespace Domain\Sessions\Entities;

use Carbon\Carbon;

class Session
{
    public function __construct(
        public ?int $id,
        public string $code,
        public int $filiereId,
        public int $formateurId,
        public int $etablissementId,
        public Carbon $dateDebut,
        public Carbon $dateFin,
        public int $nbPlaces = 0,
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function estEnCours(): bool
    {
        $now = Carbon::now();
        return $this->dateDebut <= $now && $this->dateFin >= $now;
    }

    public function estTerminee(): bool
    {
        return $this->dateFin < Carbon::now();
    }

    public function estAVenir(): bool
    {
        return $this->dateDebut > Carbon::now();
    }

    public function getDureeEnJours(): int
    {
        return $this->dateDebut->diffInDays($this->dateFin);
    }
}
```

## app/Domain/Sessions/Exceptions/SessionPleineException.php

```php

```

## app/Domain/Sessions/Ports/SessionRepositoryInterface.php

```php

```

## app/Domain/Sessions/Rules/SessionRules.php

```php

```

## app/Domain/Sessions/ValueObjects/CodeSession.php

```php

```

## app/Domain/Sessions/ValueObjects/NbPlaces.php

```php

```

## app/Domain/Sessions/ValueObjects/Periode.php

```php

```

## app/Http/Controllers/Admin/AffectationController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Application\Notifications\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class AffectationController extends Controller
{
    /**
     * Liste des affectations avec filtres
     */
    public function index()
    {
        $affectations = AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->when(request('search'), function ($q, $s) {
                $q->whereHas('formateur', function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('matricule', 'like', "%{$s}%");
                });
            })
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('filiere_id'), fn($q, $id) => $q->where('filiere_id', $id))
            ->latest('date_debut')
            ->paginate(20)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.affectations.index', compact(
            'affectations',
            'etablissements',
            'filieres'
        ));
    }

    /**
     * Formulaire de création (AJAX pour modal)
     */
    public function create()
    {
        $formateurs = FormateurModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        // AJAX : retourner juste le HTML du formulaire
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.affectations.partials.form', compact(
                    'formateurs',
                    'filieres',
                    'etablissements'
                ))->render(),
            ]);
        }

        return view('admin.affectations.create', compact(
            'formateurs',
            'filieres',
            'etablissements'
        ));
    }

    /**
     * Enregistrer une nouvelle affectation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ]);

        $affectation = AffectationModel::create($validated);

        $formateur = FormateurModel::find($validated['formateur_id']);
        $filiere = FiliereModel::find($validated['filiere_id']);

        // Créer la session automatiquement
        if ($formateur && $filiere) {
            $code = SessionModel::generateNextCode();

            SessionModel::create([
                'code'             => $code,
                'titre'            => 'Session ' . $filiere->libelle,
                'filiere_id'       => $validated['filiere_id'],
                'formateur_id'     => $validated['formateur_id'],
                'etablissement_id' => $validated['etablissement_id'],
                'date_debut'       => $validated['date_debut'],
                'date_fin'         => $validated['date_fin'] ?? now()->addMonths(6)->toDateString(),
                'nb_places'        => 0,
                'description'      => null,
                'statut'           => 'actif',
            ]);

            NotificationService::sessionCreee(
                $code,
                $formateur->prenom . ' ' . $formateur->nom,
                route('admin.sessions.index')
            );

            NotificationService::affectationCreee(
                $formateur->prenom . ' ' . $formateur->nom,
                $filiere->libelle,
                route('admin.affectations.index')
            );
        }

        // AJAX : retourner JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Affectation créée.',
                'redirect' => route('admin.affectations.index'),
            ]);
        }

        return redirect()->route('admin.affectations.index')
            ->with('success', 'Affectation créée.');
    }

    /**
     * Afficher une affectation (AJAX pour modal show)
     */
    public function show(int $id)
    {
        $affectation = AffectationModel::with([
            'formateur.filiere',
            'formateur.etablissement',
            'filiere',
            'etablissement',
        ])->findOrFail($id);

        // AJAX : retourner juste le HTML du détail
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.affectations.partials.show', compact('affectation'))->render(),
            ]);
        }

        return view('admin.affectations.show', compact('affectation'));
    }

    /**
     * Formulaire d'édition (AJAX pour modal)
     */
    public function edit(int $id)
    {
        $affectation = AffectationModel::findOrFail($id);
        $formateurs = FormateurModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $etablissements = EtablissementModel::orderBy('nom')->get();

        // AJAX : retourner juste le HTML du formulaire
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.affectations.partials.form', compact(
                    'affectation',
                    'formateurs',
                    'filieres',
                    'etablissements'
                ))->render(),
            ]);
        }

        return view('admin.affectations.edit', compact(
            'affectation',
            'formateurs',
            'filieres',
            'etablissements'
        ));
    }

    /**
     * Mettre à jour une affectation
     */
    public function update(Request $request, int $id)
    {
        $affectation = AffectationModel::findOrFail($id);

        $validated = $request->validate([
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ]);

        $affectation->update($validated);

        $formateur = FormateurModel::find($validated['formateur_id']);
        if ($formateur) {
            NotificationService::affectationModifiee(
                $formateur->prenom . ' ' . $formateur->nom,
                route('admin.affectations.index')
            );
        }

        // AJAX : retourner JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Affectation mise à jour.',
                'redirect' => route('admin.affectations.index'),
            ]);
        }

        return redirect()->route('admin.affectations.index')
            ->with('success', 'Affectation mise à jour.');
    }

    /**
     * Supprimer une affectation
     */
    public function destroy(int $id)
    {
        AffectationModel::findOrFail($id)->delete();

        return redirect()->route('admin.affectations.index')
            ->with('success', 'Affectation supprimée.');
    }
}
```

## app/Http/Controllers/Admin/DashboardController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'formateurs'     => FormateurModel::count(),
            'etablissements' => EtablissementModel::count(),
            'filieres'       => FiliereModel::count(),
            'affectations'   => AffectationModel::count(),
        ];

        $dernieresAffectations = AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->latest()
            ->take(5)
            ->get();

        $notifications = Notification::where('lu', false)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'dernieresAffectations',
            'notifications'
        ));
    }

    public function search(Request $request)
    {
        $term = $request->input('q', '');

        if (strlen($term) < 2) {
            return response()->json([]);
        }

        $s = '%' . $term . '%';

        $formateurs = FormateurModel::where(function ($q) use ($s) {
                $q->where('nom', 'like', $s)
                  ->orWhere('prenom', 'like', $s)
                  ->orWhere('matricule', 'like', $s)
                  ->orWhere('email', 'like', $s);
            })
            ->limit(5)
            ->get()
            ->map(fn($f) => [
                'type'  => 'formateur',
                'id'    => $f->id,
                'label' => $f->nom . ' ' . $f->prenom . ' (' . $f->matricule . ')',
                'url'   => route('admin.formateurs.show', $f->id),
            ]);

        $etablissements = EtablissementModel::where(function ($q) use ($s) {
                $q->where('nom', 'like', $s)
                  ->orWhere('code', 'like', $s);
            })
            ->limit(5)
            ->get()
            ->map(fn($e) => [
                'type'  => 'etablissement',
                'id'    => $e->id,
                'label' => $e->nom . ' (' . $e->code . ')',
                'url'   => route('admin.etablissements.show', $e->id),
            ]);

        return response()->json($formateurs->concat($etablissements)->values());
    }

    public function formateursByEtablissement(Request $request)
    {
        $etablissementId = $request->input('etablissement_id');

        $query = FormateurModel::with('etablissement');

        if ($etablissementId) {
            $query->where('etablissement_id', $etablissementId);
        }

        $formateurs = $query->orderBy('nom')->get()->map(fn($f) => [
            'id'            => $f->id,
            'matricule'     => $f->matricule,
            'nom_complet'   => $f->nom . ' ' . $f->prenom,
            'email'         => $f->email,
            'telephone'     => $f->telephone,
            'etablissement' => $f->etablissement?->nom,
            'statut'        => $f->statut,
        ]);

        return response()->json([
            'count'      => $formateurs->count(),
            'formateurs' => $formateurs,
        ]);
    }

    /**
     * Retourne les notifications (pour le dropdown)
     */
    public function notifications()
    {
        $notifications = Notification::latest()->take(15)->get()->map(fn($n) => [
            'id' => $n->id,
            'titre' => $n->titre,
            'message' => $n->message,
            'type' => $n->type,
            'icone' => $n->icone,
            'lu' => $n->lu,
            'lien' => $n->lien,
            'date' => $n->created_at?->diffForHumans(),
        ]);

        $nonLues = Notification::where('lu', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'non_lues' => $nonLues,
        ]);
    }

    /**
     * Marquer une notification comme lue
     */
    public function markNotificationAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['lu' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marquer toutes les notifications comme lues
     */
    public function markAllNotificationsAsRead()
    {
        Notification::where('lu', false)->update(['lu' => true]);
        return response()->json(['success' => true]);
    }
}
```

## app/Http/Controllers/Admin/EtablissementController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Application\Notifications\Services\NotificationService;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class EtablissementController extends Controller
{
    /**
     * Liste des établissements avec filtres
     */
    public function index()
    {
        $etablissements = EtablissementModel::withCount(['formateurs', 'sessions'])
            ->search(request('search'))
            ->when(request('type'), fn($q, $t) => $q->where('type', $t))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('region'), fn($q, $r) => $q->where('region', $r))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        $regions = EtablissementModel::query()
            ->whereNotNull('region')
            ->distinct()
            ->orderBy('region')
            ->pluck('region');

        return view('admin.etablissements.index', compact('etablissements', 'regions'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.etablissements.create');
    }

    /**
     * Enregistrer un nouvel établissement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'                => 'required|string|unique:etablissements,code',
            'nom'                 => 'required|string|max:150',
            'type'                => 'required|in:CFP,LTP,Lycee,Autre',
            'region'              => 'nullable|string|max:100',
            'adresse'             => 'nullable|string|max:255',
            'contact_responsable' => 'nullable|string|max:150',
            'email'               => 'nullable|email|max:150',
            'statut'              => 'required|in:actif,inactif,suspendu',
        ]);

        $etablissement = EtablissementModel::create($validated);

        NotificationService::etablissementCree(
            $etablissement->nom,
            route('admin.etablissements.show', $etablissement->id)
        );

        return redirect()->route('admin.etablissements.index')
            ->with('success', 'Établissement créé avec succès.');
    }

    /**
     * Afficher un établissement + ses formateurs + ses sessions
     */
    public function show(int $id)
    {
        $etablissement = EtablissementModel::with([
            'formateurs' => function ($q) {
                $q->orderBy('nom')->orderBy('prenom');
            },
            'formateurs.filiere',
            'sessions' => function ($q) {
                $q->with(['formateur', 'filiere'])->latest();
            },
        ])->findOrFail($id);

        return view('admin.etablissements.show', compact('etablissement'));
    }

    /**
     * Formulaire d'édition
     */
    public function edit(int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);
        return view('admin.etablissements.edit', compact('etablissement'));
    }

    /**
     * Mettre à jour un établissement
     */
    public function update(Request $request, int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);

        $validated = $request->validate([
            'code'                => 'required|string|unique:etablissements,code,' . $id,
            'nom'                 => 'required|string|max:150',
            'type'                => 'required|in:CFP,LTP,Lycee,Autre',
            'region'              => 'nullable|string|max:100',
            'adresse'             => 'nullable|string|max:255',
            'contact_responsable' => 'nullable|string|max:150',
            'email'               => 'nullable|email|max:150',
            'statut'              => 'required|in:actif,inactif,suspendu',
        ]);

        $etablissement->update($validated);

        return redirect()->route('admin.etablissements.index')
            ->with('success', 'Établissement mis à jour.');
    }

    /**
     * Supprimer un établissement
     */
    public function destroy(int $id)
    {
        $etablissement = EtablissementModel::findOrFail($id);
        $nom = $etablissement->nom;
        $etablissement->delete();

        NotificationService::suppression('Établissement', $nom);

        return redirect()->route('admin.etablissements.index')
            ->with('success', 'Établissement supprimé.');
    }
}
```

## app/Http/Controllers/Admin/FiliereController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Application\Filieres\DTOs\CreateFiliereDTO;
use Application\Filieres\UseCases\CreateFiliereUseCase;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;

class FiliereController extends Controller
{
    public function __construct(
        private CreateFiliereUseCase $createUseCase,
    ) {}

    public function index()
    {
        $filieres = FiliereModel::with('options')
            ->withCount('formateurs')
            ->search(request('search'))
            ->orderBy('libelle')
            ->paginate(15)
            ->withQueryString();

        return view('admin.filieres.index', compact('filieres'));
    }

    public function create()
    {
        return view('admin.filieres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'         => 'required|string|unique:filieres,code',
            'libelle'      => 'required|string|max:200',
            'description'  => 'nullable|string',
            'options_text' => 'nullable|string',
        ]);

        $options = [];
        if (!empty($validated['options_text'])) {
            $options = array_filter(array_map('trim', explode("\n", $validated['options_text'])));
        }

        $validated['niveau_id']  = null;
        $validated['secteur_id'] = null;

        $dto = CreateFiliereDTO::fromArray($validated, $options);
        $this->createUseCase->execute($dto);

        return redirect()->route('admin.filieres.index')
            ->with('success', 'Filière créée.');
    }

    public function show(int $id)
    {
        $filiere = FiliereModel::with(['options', 'formateurs.etablissement'])
            ->withCount('formateurs')
            ->findOrFail($id);

        return view('admin.filieres.show', compact('filiere'));
    }

    public function edit(int $id)
    {
        $filiere = FiliereModel::with('options')->findOrFail($id);
        return view('admin.filieres.edit', compact('filiere'));
    }

    public function update(Request $request, int $id)
    {
        $filiere = FiliereModel::findOrFail($id);

        $validated = $request->validate([
            'code'        => 'required|string|unique:filieres,code,' . $id,
            'libelle'     => 'required|string|max:200',
            'description' => 'nullable|string',
        ]);

        $filiere->update($validated);

        return redirect()->route('admin.filieres.index')
            ->with('success', 'Filière mise à jour.');
    }

    public function destroy(int $id)
    {
        FiliereModel::findOrFail($id)->delete();
        return redirect()->route('admin.filieres.index')
            ->with('success', 'Filière supprimée.');
    }
}
```

## app/Http/Controllers/Admin/FormateurController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formateur\StoreFormateurRequest;
use App\Http\Requests\Formateur\UpdateFormateurRequest;
use Application\Formateurs\DTOs\CreateFormateurDTO;
use Application\Formateurs\DTOs\UpdateFormateurDTO;
use Application\Formateurs\UseCases\CreateFormateur\CreateFormateurUseCase;
use Application\Formateurs\UseCases\DeleteFormateur\DeleteFormateurUseCase;
use Application\Formateurs\UseCases\UpdateFormateur\UpdateFormateurUseCase;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurController extends Controller
{
    public function __construct(
        private FormateurRepositoryInterface $repository,
        private CreateFormateurUseCase $createUseCase,
        private UpdateFormateurUseCase $updateUseCase,
        private DeleteFormateurUseCase $deleteUseCase,
    ) {}

    public function index()
    {
        $formateurs = FormateurModel::with(['etablissement', 'filiere'])
            ->search(request('search'))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('filiere_id'), fn($q, $id) => $q->where('filiere_id', $id))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(15)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.index', compact('formateurs', 'etablissements', 'filieres'));
    }

    public function create()
    {
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();
        $nextMatricule = FormateurModel::generateNextMatricule();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.formateurs.partials.form', compact(
                    'etablissements', 'filieres', 'nextMatricule'
                ))->render(),
                'matricule' => $nextMatricule,
            ]);
        }

        return view('admin.formateurs.create', compact('etablissements', 'filieres', 'nextMatricule'));
    }

    public function store(StoreFormateurRequest $request)
    {
        try {
            $dto = CreateFormateurDTO::fromArray($request->validated());
            $this->createUseCase->execute($dto);

            $model = FormateurModel::where('matricule', $request->matricule)->first();
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success'  => true,
                    'message'  => 'Formateur cree avec succes.',
                    'redirect' => route('admin.formateurs.index'),
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur cree avec succes.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show(int $id)
    {
        $formateur = FormateurModel::with([
            'etablissement', 'filiere',
            'affectations.filiere', 'affectations.etablissement',
            'sessions.filiere', 'sessions.etablissement',
        ])->findOrFail($id);

        $stats = [
            'affectations_total'   => $formateur->affectations->count(),
            'affectations_actives' => $formateur->affectations->where('statut', 'actif')->count(),
            'sessions_total'       => $formateur->sessions->count(),
            'filieres_total'       => $formateur->filiere ? 1 : 0,
        ];

        return view('admin.formateurs.show', compact('formateur', 'stats'));
    }

    public function edit(int $id)
    {
        $formateur = FormateurModel::findOrFail($id);
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.formateurs.edit', compact('formateur', 'etablissements', 'filieres'));
    }

    public function update(UpdateFormateurRequest $request, int $id)
    {
        try {
            $dto = UpdateFormateurDTO::fromArray($id, $request->validated());
            $this->updateUseCase->execute($dto);

            $model = FormateurModel::find($id);
            if ($model) {
                $model->update([
                    'filiere_id' => $request->filiere_id,
                    'statut'     => $request->statut,
                ]);
            }

            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur mis a jour.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteUseCase->execute($id);
            return redirect()->route('admin.formateurs.index')
                ->with('success', 'Formateur supprime.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
```

## app/Http/Controllers/Admin/NiveauController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = NiveauModel::withCount('filieres')->get();
        return view('admin.niveaux.index', compact('niveaux'));
    }

    public function create()
    {
        return view('admin.niveaux.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:niveaux,code',
            'libelle' => 'required|string',
            'description' => 'nullable|string',
        ]);

        NiveauModel::create($validated);

        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau créé.');
    }

    public function show(int $id)
    {
        $niveau = NiveauModel::with('filieres')->findOrFail($id);
        return view('admin.niveaux.show', compact('niveau'));
    }

    public function edit(int $id)
    {
        $niveau = NiveauModel::findOrFail($id);
        return view('admin.niveaux.edit', compact('niveau'));
    }

    public function update(Request $request, int $id)
    {
        $niveau = NiveauModel::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:niveaux,code,' . $id,
            'libelle' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $niveau->update($validated);

        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau mis à jour.');
    }

    public function destroy(int $id)
    {
        NiveauModel::findOrFail($id)->delete();
        return redirect()->route('admin.niveaux.index')->with('success', 'Niveau supprimé.');
    }
}
```

## app/Http/Controllers/Admin/NotificationController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::query()->latest();

        if ($request->filled('statut')) {
            if ($request->statut === 'non_lues') {
                $query->where('lu', false);
            } elseif ($request->statut === 'lues') {
                $query->where('lu', true);
            }
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        $notifications = $query->paginate(20)->withQueryString();

        $stats = [
            'total'    => Notification::count(),
            'non_lues' => Notification::where('lu', false)->count(),
            'lues'     => Notification::where('lu', true)->count(),
        ];

        return view('admin.notifications.index', compact('notifications', 'stats'));
    }

    public function markAsRead(int $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification marquée comme lue.');
    }

    public function markAllAsRead()
    {
        Notification::where('lu', false)->update(['lu' => true]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Toutes les notifications sont marquées comme lues.');
    }

    public function destroy(int $id)
    {
        Notification::findOrFail($id)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification supprimée.');
    }

    public function destroyAll()
    {
        Notification::where('lu', true)->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notifications lues supprimées.');
    }
}
```

## app/Http/Controllers/Admin/PdfController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Services\PdfExporterInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;

class PdfController extends Controller
{
    public function __construct(
        private PdfExporterInterface $pdf,
    ) {}

    /**
     * Page d'accueil des rapports
     */
    public function index()
    {
        $etablissements = EtablissementModel::orderBy('nom')->get();
        $filieres = FiliereModel::orderBy('libelle')->get();

        return view('admin.rapports.index', compact('etablissements', 'filieres'));
    }

    /**
     * Liste des formateurs (avec filtres)
     */
    public function formateurs(Request $request)
    {
        $query = FormateurModel::with('etablissement');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('etablissement_id')) {
            $query->where('etablissement_id', $request->etablissement_id);
        }

        $formateurs = $query->orderBy('nom')->get();

        return $this->pdf->generate(
            'pdf.formateurs.liste',
            compact('formateurs'),
            'liste-formateurs-' . now()->format('Y-m-d')
        );
    }

    /**
     * Fiche individuelle d'un formateur
     */
    public function formateur(int $id)
    {
        $formateur = FormateurModel::with([
            'etablissement',
            'filieres',
            'affectations.filiere',
            'affectations.etablissement',
        ])->findOrFail($id);

        return $this->pdf->generate(
            'pdf.formateurs.fiche',
            compact('formateur'),
            'fiche-formateur-' . $formateur->matricule
        );
    }

    /**
     * Liste des formateurs par établissement
     */
    public function formateursParEtablissement(Request $request)
    {
        $etablissementId = $request->input('etablissement_id');

        $query = EtablissementModel::with(['formateurs' => function ($q) {
            $q->orderBy('nom')->orderBy('prenom');
        }]);

        if ($etablissementId) {
            $query->where('id', $etablissementId);
        }

        $etablissements = $query->orderBy('nom')->get();

        return $this->pdf->generate(
            'pdf.formateurs.par-etablissement',
            compact('etablissements'),
            'formateurs-par-etablissement-' . now()->format('Y-m-d')
        );
    }

    /**
     * Liste des formateurs par filière
     * ⚠️ niveau et secteur retirés (suppression UI)
     */
    public function formateursParFiliere(Request $request)
    {
        $filiereId = $request->input('filiere_id');

        $query = FiliereModel::with([
            'formateurs' => function ($q) {
                $q->orderBy('nom')->orderBy('prenom');
            }
        ]);

        if ($filiereId) {
            $query->where('id', $filiereId);
        }

        $filieres = $query->orderBy('libelle')->get();

        return $this->pdf->generate(
            'pdf.formateurs.par-filiere',
            compact('filieres'),
            'formateurs-par-filiere-' . now()->format('Y-m-d')
        );
    }

    /**
     * Liste des affectations (avec filtres)
     */
    public function affectations(Request $request)
    {
        $query = AffectationModel::with(['formateur', 'filiere', 'etablissement']);

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('etablissement_id')) {
            $query->where('etablissement_id', $request->etablissement_id);
        }
        if ($request->filled('date_debut')) {
            $query->where('date_debut', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->where('date_fin', '<=', $request->date_fin);
        }

        $affectations = $query->orderBy('date_debut', 'desc')->get();

        return $this->pdf->generate(
            'pdf.affectations.liste',
            compact('affectations'),
            'liste-affectations-' . now()->format('Y-m-d')
        );
    }

    /**
     * Rapport de statistiques globales
     */
    public function statistiques()
    {
        $stats = [
            'total_formateurs'      => FormateurModel::count(),
            'formateurs_actifs'     => FormateurModel::where('statut', 'actif')->count(),
            'formateurs_inactifs'   => FormateurModel::where('statut', 'inactif')->count(),
            'total_etablissements'  => EtablissementModel::count(),
            'total_filieres'        => FiliereModel::count(),
            'total_sessions'        => SessionModel::count(),
            'total_affectations'    => AffectationModel::count(),
            'affectations_actives'  => AffectationModel::where('statut', 'actif')->count(),
        ];

        $formateursParEtablissement = EtablissementModel::withCount('formateurs')
            ->orderBy('formateurs_count', 'desc')
            ->get();

        $formateursParStatut = [
            'actif'      => FormateurModel::where('statut', 'actif')->count(),
            'inactif'    => FormateurModel::where('statut', 'inactif')->count(),
            'en_attente' => FormateurModel::where('statut', 'en_attente')->count(),
        ];

        $affectationsParStatut = [
            'actif'    => AffectationModel::where('statut', 'actif')->count(),
            'termine'  => AffectationModel::where('statut', 'termine')->count(),
            'suspendu' => AffectationModel::where('statut', 'suspendu')->count(),
        ];

        $topEtablissements = EtablissementModel::withCount('formateurs')
            ->orderBy('formateurs_count', 'desc')
            ->take(10)
            ->get();

        return $this->pdf->generate(
            'pdf.statistiques.global',
            compact(
                'stats',
                'formateursParEtablissement',
                'formateursParStatut',
                'affectationsParStatut',
                'topEtablissements'
            ),
            'statistiques-globales-' . now()->format('Y-m-d')
        );
    }
}
```

## app/Http/Controllers/Admin/SecteurController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class SecteurController extends Controller
{
    public function index()
    {
        $secteurs = SecteurModel::withCount('filieres')->get();
        return view('admin.secteurs.index', compact('secteurs'));
    }

    public function create()
    {
        return view('admin.secteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:secteurs,code',
            'libelle' => 'required|string',
        ]);

        SecteurModel::create($validated);

        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur créé.');
    }

    public function show(int $id)
    {
        $secteur = SecteurModel::with('filieres')->findOrFail($id);
        return view('admin.secteurs.show', compact('secteur'));
    }

    public function edit(int $id)
    {
        $secteur = SecteurModel::findOrFail($id);
        return view('admin.secteurs.edit', compact('secteur'));
    }

    public function update(Request $request, int $id)
    {
        $secteur = SecteurModel::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|unique:secteurs,code,' . $id,
            'libelle' => 'required|string',
        ]);

        $secteur->update($validated);

        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur mis à jour.');
    }

    public function destroy(int $id)
    {
        SecteurModel::findOrFail($id)->delete();
        return redirect()->route('admin.secteurs.index')->with('success', 'Secteur supprimé.');
    }
}
```

## app/Http/Controllers/Admin/SessionController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = SessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->search(request('search'))
            ->when(request('statut'), fn($q, $s) => $q->where('statut', $s))
            ->when(request('etablissement_id'), fn($q, $id) => $q->where('etablissement_id', $id))
            ->when(request('formateur_id'), fn($q, $id) => $q->where('formateur_id', $id))
            ->when(request('date_debut'), fn($q, $d) => $q->where('date_debut', '>=', $d))
            ->when(request('date_fin'), fn($q, $d) => $q->where('date_fin', '<=', $d))
            ->orderByRaw("CASE 
                WHEN statut = 'active' AND date_debut <= date('now') AND date_fin >= date('now') THEN 1
                WHEN statut = 'active' AND date_debut > date('now') THEN 2
                WHEN statut = 'terminee' THEN 3
                WHEN statut = 'annulee' THEN 4
                ELSE 5
            END")
            ->orderBy('date_debut', 'desc')
            ->paginate(20)
            ->withQueryString();

        $etablissements = EtablissementModel::orderBy('nom')->get();
        $formateurs = FormateurModel::orderBy('nom')->get();

        return view('admin.sessions.index', compact('sessions', 'etablissements', 'formateurs'));
    }

    public function show(int $id)
    {
        $session = SessionModel::with(['formateur', 'filiere', 'etablissement'])
            ->findOrFail($id);

        return view('admin.sessions.show', compact('session'));
    }

    /**
     * ⚠️ SUPPRIMÉ : create, store, edit, update, destroy
     * Les sessions sont créées automatiquement via AffectationObserver
     */
}
```

## app/Http/Controllers/Admin/UserController.php

```php
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs
     */
    public function index(Request $request)
    {
        $users = AdminModel::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = $request->search;
                $q->where(function ($qq) use ($s) {
                    $qq->where('nom', 'like', "%{$s}%")
                       ->orWhere('prenom', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->when($request->filled('role'), fn($q) => $q->where('role', $request->role))
            ->orderBy('nom')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Formulaire de création (AJAX pour modal)
     */
    public function create()
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form')->render(),
            ]);
        }

        return view('admin.users.create');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        AdminModel::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin créé.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin créé.');
    }

    /**
     * Afficher un utilisateur (AJAX pour modal show)
     */
    public function show(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.show', compact('user'))->render(),
            ]);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Formulaire d'édition (AJAX pour modal)
     */
    public function edit(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.form', compact('user'))->render(),
            ]);
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = AdminModel::findOrFail($id);
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'Compte admin mis à jour.',
                'redirect' => route('admin.users.index'),
            ]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin mis à jour.');
    }

    /**
     * Supprimer un utilisateur (form classique, pas AJAX)
     */
    public function destroy(int $id)
    {
        $user = AdminModel::findOrFail($id);

        if (auth('admin')->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Compte admin supprimé.');
    }
}
```

## app/Http/Controllers/Auth/Admin/ForgotPasswordController.php

```php
<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Afficher le formulaire de demande de réinitialisation
     */
    public function showLinkRequestForm()
    {
        return view('auth.admin.forgot-password');
    }

    /**
     * Envoyer le lien de réinitialisation par email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
```

## app/Http/Controllers/Auth/Admin/LoginController.php

```php
<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Ces identifiants ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }
}
```

## app/Http/Controllers/Auth/Admin/LogoutController.php

```php
<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Vous avez été déconnecté.');
    }
}
```

## app/Http/Controllers/Auth/Admin/RegisterController.php

```php
<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.admin.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ⚠️ PAS de Hash::make() — le cast 'hashed' du modèle s'en charge
        $admin = AdminModel::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Compte administrateur créé avec succès.');
    }
}
```

## app/Http/Controllers/Auth/Admin/ResetPasswordController.php

```php
<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token = null)
    {
        return view('auth.admin.reset-password')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (AdminModel $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
```

## app/Http/Controllers/Auth/Formateur/ForgotPasswordController.php

```php
<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.formateur.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::broker('formateurs')->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
```

## app/Http/Controllers/Auth/Formateur/LoginController.php

```php
<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.formateur.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('formateur')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Mise à jour de la date de dernière connexion
            $user = Auth::guard('formateur')->user();
            $user->last_login_at = now();
            $user->save();

            return redirect()->intended(route('formateur.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Ces identifiants ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }
}
```

## app/Http/Controllers/Auth/Formateur/LogoutController.php

```php
<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('formateur')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('formateur.login')
            ->with('success', 'Vous avez été déconnecté.');
    }
}
```

## app/Http/Controllers/Auth/Formateur/RegisterController.php

```php
<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.formateur.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:formateurs_users,email',
            'matricule' => 'required|string|unique:formateurs_users,matricule',
            'telephone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ⚠️ PAS de Hash::make() — le cast 'hashed' du modèle s'en charge
        $formateur = FormateurUserModel::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'matricule' => $validated['matricule'],
            'telephone' => $validated['telephone'] ?? null,
            'password' => $validated['password'],
            'statut' => 'en_attente',
        ]);

        Auth::guard('formateur')->login($formateur);

        return redirect()->route('formateur.dashboard')
            ->with('success', 'Votre compte formateur a été créé. Il est en attente de validation.');
    }
}
```

## app/Http/Controllers/Auth/Formateur/ResetPasswordController.php

```php
<?php

namespace App\Http\Controllers\Auth\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token = null)
    {
        return view('auth.formateur.reset-password')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('formateurs')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (FormateurUserModel $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('formateur.login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
```

## app/Http/Controllers/Controller.php

```php
<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
```

## app/Http/Controllers/Formateur/AffectationController.php

```php
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.affectations.index', [
                'affectations' => collect(),
                'formateurMetier' => null,
            ]);
        }

        $affectations = AffectationModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->latest('date_debut')
            ->get();

        return view('formateur.affectations.index', compact('affectations', 'formateurMetier'));
    }

    public function show(int $id)
    {
        $formateurMetier = $this->getFormateurMetier();
        abort_if(!$formateurMetier, 403);

        $affectation = AffectationModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'filiere.options', 'etablissement'])
            ->findOrFail($id);

        return view('formateur.affectations.show', compact('affectation', 'formateurMetier'));
    }
}
```

## app/Http/Controllers/Formateur/DashboardController.php

```php
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class DashboardController extends Controller
{
    public function index()
    {
        $formateur = Auth::guard('formateur')->user();

        $formateurMetier = FormateurModel::where('matricule', $formateur->matricule)
            ->orWhere('email', $formateur->email)
            ->first();

        $stats = [
            'affectations' => $formateurMetier ? AffectationModel::where('formateur_id', $formateurMetier->id)->count() : 0,
            'sessions' => $formateurMetier ? SessionModel::where('formateur_id', $formateurMetier->id)->count() : 0,
        ];

        $taux = 0;

        return view('formateur.dashboard.index', compact('formateur', 'formateurMetier', 'stats', 'taux'));
    }
}
```

## app/Http/Controllers/Formateur/PdfFormateurController.php

```php
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Services\PdfExporterInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class PdfFormateurController extends Controller
{
    public function __construct(
        private PdfExporterInterface $pdf,
    ) {}

    /**
     * Fiche PDF de mon profil (formateur connecté)
     */
    public function maFiche()
    {
        $formateur = $this->getFormateurConnecte();

        return $this->pdf->generate(
            'pdf.formateurs.fiche',
            compact('formateur'),
            'ma-fiche-' . $formateur->matricule
        );
    }

    /**
     * Liste PDF de mes affectations
     */
    public function mesAffectations()
    {
        $formateur = $this->getFormateurConnecte();

        $affectations = AffectationModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateur->id)
            ->orderBy('date_debut', 'desc')
            ->get();

        return $this->pdf->generate(
            'pdf.affectations.liste',
            compact('affectations', 'formateur'),
            'mes-affectations-' . $formateur->matricule
        );
    }

    /**
     * Liste PDF de mes sessions
     */
    public function mesSessions()
    {
        $formateur = $this->getFormateurConnecte();

        $sessions = SessionModel::with(['filiere', 'etablissement'])
            ->where('formateur_id', $formateur->id)
            ->orderBy('date_debut', 'desc')
            ->get();

        return $this->pdf->generate(
            'pdf.sessions.liste',
            compact('sessions', 'formateur'),
            'mes-sessions-' . $formateur->matricule
        );
    }

    /**
     * Récupère le formateur authentifié ou 404
     */
    private function getFormateurConnecte(): FormateurModel
    {
        $user = Auth::guard('formateur')->user();

        return FormateurModel::with(['etablissement', 'filieres'])
            ->where('matricule', $user->matricule)
            ->firstOrFail();
    }
}
```

## app/Http/Controllers/Formateur/ProfileController.php

```php
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('formateur')->user();
        
        // Récupérer le formateur depuis la table formateurs (pas formateurs_users)
        $formateur = FormateurModel::where('matricule', $user->matricule)->firstOrFail();
        
        return view('formateur.profile.edit', compact('formateur', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('formateur')->user();
        $formateur = FormateurModel::where('matricule', $user->matricule)->firstOrFail();

        // ⚠️ IMPORTANT : 'statut' N'EST PAS dans les champs modifiables
        $validated = $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'    => 'required|string|max:100',
            'email'     => 'required|email|unique:formateurs,email,' . $formateur->id,
            'telephone' => 'nullable|string|max:20',
            'adresse'   => 'nullable|string|max:255',
        ]);

        // ⚠️ Sécurité : ne JAMAIS accepter 'statut' même si envoyé manuellement
        unset($validated['statut']);

        $formateur->update($validated);

        // Mettre à jour aussi formateurs_users si nécessaire
        $user->update([
            'nom'       => $validated['nom'],
            'prenom'    => $validated['prenom'],
            'email'     => $validated['email'],
            'telephone' => $validated['telephone'] ?? null,
        ]);

        return back()->with('success', 'Profil mis à jour.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $formateur = Auth::guard('formateur')->user();

        if (!Hash::check($request->current_password, $formateur->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $formateur->update(['password' => $request->password]);

        return back()->with('success', 'Mot de passe modifié.');
    }
}
```

## app/Http/Controllers/Formateur/SessionController.php

```php
<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionController extends Controller
{
    private function getFormateurMetier()
    {
        $user = Auth::guard('formateur')->user();
        return FormateurModel::where('matricule', $user->matricule)
            ->orWhere('email', $user->email)
            ->first();
    }

    public function index()
    {
        $formateurMetier = $this->getFormateurMetier();

        if (!$formateurMetier) {
            return view('formateur.sessions.index', [
                'sessions' => collect(),
                'formateurMetier' => null,
            ]);
        }

        $sessions = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement'])
            ->withCount('presences')
            ->latest('date_debut')
            ->get();

        return view('formateur.sessions.index', compact('sessions', 'formateurMetier'));
    }

    public function show(int $id)
    {
        $formateurMetier = $this->getFormateurMetier();
        abort_if(!$formateurMetier, 403);

        $session = SessionModel::where('formateur_id', $formateurMetier->id)
            ->with(['filiere.niveau', 'filiere.secteur', 'etablissement', 'presences'])
            ->findOrFail($id);

        return view('formateur.sessions.show', compact('session', 'formateurMetier'));
    }
}
```

## app/Http/Middleware/AdminMiddleware.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Veuillez vous connecter en tant qu\'administrateur.');
        }

        return $next($request);
    }
}
```

## app/Http/Middleware/FormateurMiddleware.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('formateur')->check()) {
            return redirect()->route('formateur.login')
                ->with('error', 'Veuillez vous connecter en tant que formateur.');
        }

        $formateur = Auth::guard('formateur')->user();

        // Formateur en attente : accès dashboard/profil uniquement
        if ($formateur->statut !== 'actif') {
            $allowedRoutes = [
                'formateur.dashboard',
                'formateur.profile.edit',
                'formateur.profile.show',
                'formateur.profile.update',
                'formateur.profile.password',
                'formateur.logout',
            ];

            $currentRoute = $request->route()?->getName();

            if (!in_array($currentRoute, $allowedRoutes, true)) {
                return redirect()->route('formateur.dashboard')
                    ->with('warning', 'Votre compte est en attente de validation.');
            }
        }

        return $next($request);
    }
}
```

## app/Http/Middleware/RedirectIfAdmin.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
```

## app/Http/Middleware/RedirectIfFormateur.php

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfFormateur
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('formateur')->check()) {
            return redirect()->route('formateur.dashboard');
        }

        return $next($request);
    }
}
```

## app/Http/Requests/Affectation/StoreAffectationRequest.php

```php
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }

    public function messages(): array
    {
        return [
            'formateur_id.required'     => 'Le formateur est obligatoire.',
            'filiere_id.required'       => 'La filière est obligatoire.',
            'etablissement_id.required' => 'L\'établissement est obligatoire.',
            'date_debut.required'       => 'La date de début est obligatoire.',
            'date_fin.after_or_equal'   => 'La date de fin doit être après la date de début.',
            'statut.in'                 => 'Le statut doit être : actif, termine ou suspendu.',
        ];
    }
}
```

## app/Http/Requests/Affectation/UpdateAffectationRequest.php

```php
<?php

namespace App\Http\Requests\Affectation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffectationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'formateur_id'     => 'required|exists:formateurs,id',
            'filiere_id'       => 'required|exists:filieres,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
            'statut'           => 'required|in:actif,termine,suspendu',
        ];
    }
}
```

## app/Http/Requests/Auth/Admin/LoginAdminRequest.php

```php
<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
```

## app/Http/Requests/Auth/Admin/RegisterAdminRequest.php

```php
<?php

namespace App\Http\Requests\Auth\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
```

## app/Http/Requests/Auth/Formateur/LoginFormateurRequest.php

```php

```

## app/Http/Requests/Auth/Formateur/RegisterFormateurRequest.php

```php

```

## app/Http/Requests/Etablissement/StoreEtablissementRequest.php

```php
<?php

namespace App\Http\Requests\Etablissement;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtablissementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'unique:etablissements,code'],
            'nom' => ['required', 'string', 'max:150'],
            'type' => ['required', 'in:CFP,LTP,Lycee,Autre'],
            'region' => ['nullable', 'string', 'max:100'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150'],
        ];
    }
}
```

## app/Http/Requests/Etablissement/UpdateEtablissementRequest.php

```php
<?php

namespace App\Http\Requests\Etablissement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEtablissementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('etablissement');

        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('etablissements', 'code')->ignore($id)],
            'nom' => ['required', 'string', 'max:150'],
            'type' => ['required', 'in:CFP,LTP,Lycee,Autre'],
            'region' => ['nullable', 'string', 'max:100'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:150'],
        ];
    }
}
```

## app/Http/Requests/Filiere/StoreFiliereRequest.php

```php

```

## app/Http/Requests/Filiere/UpdateFiliereRequest.php

```php

```

## app/Http/Requests/Formateur/StoreFormateurRequest.php

```php
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'matricule'        => ['required', 'string', 'max:50', 'unique:formateurs,matricule', 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', 'unique:formateurs,email'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }

    public function messages(): array
    {
        return [
            'matricule.regex'  => 'Le matricule doit suivre le format FORM-XXX.',
            'matricule.unique' => 'Ce matricule est deja utilise.',
            'email.unique'     => 'Cet email est deja utilise.',
            'statut.in'        => 'Le statut doit etre : actif, inactif ou suspendu.',
        ];
    }
}
```

## app/Http/Requests/Formateur/UpdateFormateurRequest.php

```php
<?php

namespace App\Http\Requests\Formateur;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormateurRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('formateur');

        return [
            'matricule'        => ['required', 'string', 'max:50', Rule::unique('formateurs', 'matricule')->ignore($id), 'regex:/^FORM-\d{3,}$/'],
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255', Rule::unique('formateurs', 'email')->ignore($id)],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'sexe'             => ['nullable', 'in:Masculin,Feminin'],
            'date_naissance'   => ['nullable', 'date'],
            'lieu_naissance'   => ['nullable', 'string', 'max:150'],
            'cin'              => ['nullable', 'string', 'max:50'],
            'adresse'          => ['nullable', 'string', 'max:255'],
            'grade'            => ['required', 'string', 'max:50'],
            'date_recrutement' => ['nullable', 'date'],
            'etablissement_id' => ['nullable', 'exists:etablissements,id'],
            'filiere_id'       => ['nullable', 'exists:filieres,id'],
            'statut'           => ['required', 'in:actif,inactif,suspendu'],
        ];
    }
}
```

## app/Http/Requests/Niveau/StoreNiveauRequest.php

```php

```

## app/Http/Requests/Niveau/UpdateNiveauRequest.php

```php

```

## app/Http/Requests/Secteur/StoreSecteurRequest.php

```php

```

## app/Http/Requests/Secteur/UpdateSecteurRequest.php

```php

```

## app/Http/Requests/Session/StoreSessionRequest.php

```php

```

## app/Http/Requests/Session/UpdateSessionRequest.php

```php

```

## app/Http/Requests/User/StoreUserRequest.php

```php
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check() && auth('admin')->user()->role === 'super_admin';
    }

    public function rules(): array
    {
        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'       => 'Cet email est déjà utilisé.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.in'            => 'Le rôle doit être : super_admin, admin ou gestionnaire.',
        ];
    }
}
```

## app/Http/Requests/User/UpdateUserRequest.php

```php
<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:150', Rule::unique('admins', 'email')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,gestionnaire',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}
```

## app/Http/Resources/AffectationResource.php

```php

```

## app/Http/Resources/Auth/AdminResource.php

```php

```

## app/Http/Resources/Auth/FormateurUserResource.php

```php

```

## app/Http/Resources/EtablissementResource.php

```php

```

## app/Http/Resources/FiliereResource.php

```php

```

## app/Http/Resources/FormateurResource.php

```php

```

## app/Http/Resources/NiveauResource.php

```php

```

## app/Http/Resources/SecteurResource.php

```php

```

## app/Http/Resources/SessionResource.php

```php

```

## app/Http/ViewModels/DashboardViewModel.php

```php

```

## app/Http/ViewModels/FormateurViewModel.php

```php

```

## app/Infrastructure/Adapters/Hashing/BcryptPasswordHasher.php

```php
<?php

namespace Infrastructure\Adapters\Hashing;

use Domain\Auth\Ports\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

class BcryptPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }

    public function verify(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }
}
```

## app/Infrastructure/Adapters/Mail/LaravelMailService.php

```php

```

## app/Infrastructure/Adapters/Pdf/DompdfExporter.php

```php
<?php

namespace Infrastructure\Adapters\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Infrastructure\Services\PdfExporterInterface;

class DompdfExporter implements PdfExporterInterface
{
    public function generate(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->download($filename . '.pdf');
    }

    public function stream(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response
    {
        $pdf = Pdf::loadView($view, $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        return $pdf->stream($filename . '.pdf');
    }
}
```

## app/Infrastructure/Adapters/Session/LaravelSessionManager.php

```php

```

## app/Infrastructure/Adapters/Storage/LocalFileStorage.php

```php

```

## app/Infrastructure/Adapters/Token/LaravelTokenGenerator.php

```php

```

## app/Infrastructure/Persistence/Database/MySqlConnection.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Models/AdminModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'role', 'avatar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getNomCompletAttribute(): string
    {
        return trim(($this->prenom ?? '') . ' ' . ($this->nom ?? ''));
    }

    public function estSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function estGestionnaire(): bool
    {
        return $this->role === 'gestionnaire';
    }

    protected static function newFactory()
    {
        return \Database\Factories\AdminFactory::new();
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/AffectationModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationModel extends Model
{
    use HasFactory;

    protected $table = 'affectations';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'formateur_id', 'filiere_id', 'etablissement_id',
        'date_debut', 'date_fin', 'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    public function formateur()
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function estActive(): bool
    {
        return $this->statut === self::STATUT_ACTIF;
    }

    public function estInactive(): bool
    {
        return $this->statut === self::STATUT_INACTIF;
    }

    public function estSuspendue(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/EtablissementModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtablissementModel extends Model
{
    protected $table = 'etablissements';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'nom', 'type', 'region', 'adresse',
        'telephone', 'contact_responsable', 'email', 'statut',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateurs(): HasMany
    {
        return $this->hasMany(FormateurModel::class, 'etablissement_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'etablissement_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'etablissement_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('nom', 'like', "%{$term}%")
              ->orWhere('region', 'like', "%{$term}%")
              ->orWhere('adresse', 'like', "%{$term}%")
              ->orWhere('contact_responsable', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    // ==================== ACCESSORS ====================

    public function getContactAttribute(): ?string
    {
        return $this->contact_responsable ?? $this->telephone;
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/FiliereModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereModel extends Model
{
    protected $table = 'filieres';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'libelle', 'niveau_id', 'secteur_id', 'description', 'statut',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function niveau(): BelongsTo
    {
        return $this->belongsTo(NiveauModel::class, 'niveau_id');
    }

    public function secteur(): BelongsTo
    {
        return $this->belongsTo(SecteurModel::class, 'secteur_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(FiliereOptionModel::class, 'filiere_id');
    }

    /**
     * Formateurs dans cette filière (1-N depuis ajout formateurs.filiere_id)
     */
    public function formateurs(): HasMany
    {
        return $this->hasMany(FormateurModel::class, 'filiere_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'filiere_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'filiere_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('libelle', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/FiliereOptionModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiliereOptionModel extends Model
{
    use HasFactory;

    protected $table = 'filiere_options';

    protected $fillable = ['filiere_id', 'libelle'];

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/FormateurModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormateurModel extends Model
{
    use SoftDeletes;

    protected $table = 'formateurs';

    // ==================== STATUTS ====================
    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'sexe', 'date_naissance',
        'lieu_naissance', 'cin', 'email', 'telephone', 'adresse',
        'grade', 'date_recrutement', 'photo',
        'etablissement_id', 'filiere_id', 'statut',
    ];

    protected $casts = [
        'date_naissance'   => 'date',
        'date_recrutement' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    // ==================== RELATIONS ====================
    // ⚠️ 1 formateur = 1 établissement / 1 filière
    // 1 formateur = N affectations / N sessions (mais 1 seule active à la fois)

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'formateur_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'formateur_id');
    }

    /**
     * Retourne l'affectation active actuelle (une seule)
     */
    public function affectationActive()
    {
        return $this->hasOne(AffectationModel::class, 'formateur_id')
            ->where('statut', self::STATUT_ACTIF)
            ->latest();
    }

    /**
     * Retourne la session active actuelle (une seule)
     */
    public function sessionActive()
    {
        return $this->hasOne(SessionModel::class, 'formateur_id')
            ->where('statut', self::STATUT_ACTIF)
            ->latest();
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nom', 'like', "%{$term}%")
              ->orWhere('prenom', 'like', "%{$term}%")
              ->orWhere('matricule', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', self::STATUT_INACTIF);
    }

    public function scopeSuspendu($query)
    {
        return $query->where('statut', self::STATUT_SUSPENDU);
    }

    // ==================== MATRICULE AUTO ====================

    public static function generateNextMatricule(): string
    {
        $prefix = 'FORM-';
        $last = self::withTrashed()
            ->where('matricule', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(matricule, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('matricule');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%03d', $prefix, $numero);
    }

    // ==================== PROPAGATION STATUT ====================

    /**
     * Propage le statut du formateur à TOUTES les entités liées.
     * Appelé automatiquement quand formateurs.statut change.
     */
    public function propagerStatut(): void
    {
        $statut = $this->statut;

        // 1. Propager aux affectations
        $this->affectations()->update(['statut' => $statut]);

        // 2. Propager aux sessions
        $this->sessions()->update(['statut' => $statut]);

        // 3. Propager à l'établissement (si plus aucun formateur actif → inactif)
        $this->mettreAJourEtablissement();

        // 4. Propager à la filière (si plus aucun formateur actif → inactif)
        $this->mettreAJourFiliere();
    }

    /**
     * Met à jour le statut de l'établissement.
     * Actif si AU MOINS UN formateur actif, sinon inactif.
     */
    public function mettreAJourEtablissement(): void
    {
        if (!$this->etablissement_id) return;

        $etablissement = EtablissementModel::find($this->etablissement_id);
        if (!$etablissement) return;

        $aFormateurActif = $etablissement->formateurs()
            ->where('statut', self::STATUT_ACTIF)
            ->exists();

        $nouveauStatut = $aFormateurActif
            ? EtablissementModel::STATUT_ACTIF
            : EtablissementModel::STATUT_INACTIF;

        if ($etablissement->statut !== $nouveauStatut) {
            $etablissement->update(['statut' => $nouveauStatut]);
        }
    }

    /**
     * Met à jour le statut de la filière.
     * Actif si AU MOINS UN formateur actif, sinon inactif.
     */
    public function mettreAJourFiliere(): void
    {
        if (!$this->filiere_id) return;

        $filiere = FiliereModel::find($this->filiere_id);
        if (!$filiere) return;

        $aFormateurActif = $filiere->formateurs()
            ->where('statut', self::STATUT_ACTIF)
            ->exists();

        $nouveauStatut = $aFormateurActif
            ? FiliereModel::STATUT_ACTIF
            : FiliereModel::STATUT_INACTIF;

        if ($filiere->statut !== $nouveauStatut) {
            $filiere->update(['statut' => $nouveauStatut]);
        }
    }

    // ==================== HELPERS ====================

    public function estActif(): bool
    {
        return $this->statut === self::STATUT_ACTIF;
    }

    public function estInactif(): bool
    {
        return $this->statut === self::STATUT_INACTIF;
    }

    public function estSuspendu(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/FormateurUserModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormateurUserModel extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'formateurs_users';

    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'matricule',
        'telephone', 'etablissement_id', 'avatar', 'statut',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function etablissement()
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function formateur()
    {
        return $this->hasOne(FormateurModel::class, 'matricule', 'matricule');
    }

    public function getNomCompletAttribute(): string
    {
        return trim(($this->prenom ?? '') . ' ' . ($this->nom ?? ''));
    }

    public function estActif(): bool
    {
        return $this->statut === 'actif';
    }

    protected static function newFactory()
    {
        return \Database\Factories\FormateurUserFactory::new();
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/NiveauModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauModel extends Model
{
    use HasFactory;

    protected $table = 'niveaux';

    protected $fillable = ['code', 'libelle', 'description'];

    public function filieres()
    {
        return $this->hasMany(FiliereModel::class, 'niveau_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\NiveauFactory::new();
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/NotificationModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'titre',
        'message',
        'type',
        'icone',
        'lu',
        'lien',
        'data',
    ];

    protected $casts = [
        'lu' => 'boolean',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'user_id');
    }

    public function scopeNonLues($query)
    {
        return $query->where('lu', false);
    }

    public function scopeRecentes($query, int $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/SecteurModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurModel extends Model
{
    use HasFactory;

    protected $table = 'secteurs';

    protected $fillable = ['code', 'libelle'];

    public function filieres()
    {
        return $this->hasMany(FiliereModel::class, 'secteur_id');
    }

    protected static function newFactory()
    {
        return \Database\Factories\SecteurFactory::new();
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/SessionModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionModel extends Model
{
    protected $table = 'formations_sessions';

    public const STATUT_ACTIF    = 'actif';
    public const STATUT_INACTIF  = 'inactif';
    public const STATUT_SUSPENDU = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'code', 'titre', 'filiere_id', 'formateur_id', 'etablissement_id',
        'date_debut', 'date_fin', 'nb_places', 'description', 'statut', 'expire_le',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'expire_le'  => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('titre', 'like', "%{$term}%")
              ->orWhereHas('formateur', function ($qq) use ($term) {
                  $qq->where('nom', 'like', "%{$term}%")
                     ->orWhere('prenom', 'like', "%{$term}%")
                     ->orWhere('matricule', 'like', "%{$term}%");
              });
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', self::STATUT_INACTIF);
    }

    public function scopeSuspendu($query)
    {
        return $query->where('statut', self::STATUT_SUSPENDU);
    }

    // ==================== HELPERS ====================

    public function estEnCours(): bool
    {
        return $this->statut === self::STATUT_ACTIF
            && $this->date_debut <= now()
            && $this->date_fin >= now();
    }

    public function estTerminee(): bool
    {
        return $this->statut === self::STATUT_INACTIF
            || ($this->date_fin && $this->date_fin < now());
    }

    public function estAVenir(): bool
    {
        return $this->statut === self::STATUT_ACTIF && $this->date_debut > now();
    }

    public function estSuspendue(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }

    public function estExpiree(): bool
    {
        return $this->date_fin && $this->date_fin < now();
    }

    // ==================== GÉNÉRATION CODE AUTO ====================

    public static function generateNextCode(): string
    {
        $annee = (int) date('Y');
        $prefix = sprintf('SESS-%d-', $annee);

        $last = self::where('code', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(code, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('code');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%04d', $prefix, $numero);
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Models/UserModel.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAdminRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentAffectationRepository.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;

class EloquentAffectationRepository
{
    public function findById(int $id): ?AffectationModel
    {
        return AffectationModel::find($id);
    }

    public function findAll(): array
    {
        return AffectationModel::with(['formateur', 'filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function findByFormateur(int $formateurId): array
    {
        return AffectationModel::where('formateur_id', $formateurId)
            ->with(['filiere', 'etablissement'])
            ->orderBy('date_debut', 'desc')
            ->get()
            ->all();
    }

    public function save(array $data): AffectationModel
    {
        if (isset($data['id']) && $data['id']) {
            $model = AffectationModel::findOrFail($data['id']);
            $model->update($data);
            return $model;
        }
        return AffectationModel::create($data);
    }

    public function delete(int $id): void
    {
        AffectationModel::findOrFail($id)->delete();
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentEtablissementRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFiliereRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFormateurRepository.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domain\Formateurs\Entities\Formateur;
use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class EloquentFormateurRepository implements FormateurRepositoryInterface
{
    public function save(Formateur $formateur): Formateur
    {
        $model = $formateur->id
            ? FormateurModel::findOrFail($formateur->id)
            : new FormateurModel();

        // ✅ Utiliser toArray() pour TOUS les champs
        $model->fill($formateur->toArray());
        $model->save();

        return $this->toDomain($model);
    }

    public function findById(int $id): ?Formateur
    {
        $model = FormateurModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    public function findByMatricule(string $matricule): ?Formateur
    {
        $model = FormateurModel::where('matricule', $matricule)->first();
        return $model ? $this->toDomain($model) : null;
    }

    public function findAll(): array
    {
        return FormateurModel::with('etablissement')->get()
            ->map(fn($m) => $this->toDomain($m))
            ->all();
    }

    public function delete(int $id): void
    {
        FormateurModel::findOrFail($id)->delete();
    }

    private function toDomain(FormateurModel $model): Formateur
    {
        return Formateur::fromArray([
            'id'               => $model->id,
            'matricule'        => $model->matricule,
            'nom'              => $model->nom,
            'prenom'           => $model->prenom,
            'email'            => $model->email,
            'telephone'        => $model->telephone,
            'sexe'             => $model->sexe,
            'date_naissance'   => $model->date_naissance?->format('Y-m-d'),
            'lieu_naissance'   => $model->lieu_naissance,
            'cin'              => $model->cin,
            'adresse'          => $model->adresse,
            'grade'            => $model->grade,
            'date_recrutement' => $model->date_recrutement?->format('Y-m-d'),
            'photo'            => $model->photo,
            'etablissement_id' => $model->etablissement_id,
            'filiere_id'       => $model->filiere_id,
            'statut'           => $model->statut,
        ]);
    }
}
```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentFormateurUserRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentNiveauRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentSecteurRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentSessionRepository.php

```php

```

## app/Infrastructure/Persistence/Eloquent/Repositories/EloquentUserRepository.php

```php

```

## app/Infrastructure/Providers/HexagonalServiceProvider.php

```php

```

## app/Infrastructure/Services/PdfExporterInterface.php

```php
<?php

namespace Infrastructure\Services;

interface PdfExporterInterface
{
    /**
     * Génère un PDF (téléchargement)
     */
    public function generate(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response;

    /**
     * Génère un PDF (affichage navigateur)
     */
    public function stream(string $view, array $data, string $filename): \Symfony\Component\HttpFoundation\Response;
}
```

## app/Models/Notification.php

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 'titre', 'message', 'type', 'icone', 'lu', 'lien', 'data',
    ];

    protected $casts = [
        'lu'   => 'boolean',
        'data' => 'array',
    ];
}
```

## app/Models/User.php

```php
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

## app/Observers/AffectationObserver.php

```php
<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationObserver
{
    public function created(AffectationModel $affectation): void
    {
        // Créer session automatique
        $exists = SessionModel::where('formateur_id', $affectation->formateur_id)->exists();

        if (!$exists) {
            $formateur = FormateurModel::find($affectation->formateur_id);

            SessionModel::create([
                'code'             => SessionModel::generateNextCode(),
                'titre'            => 'Session ' . ($affectation->filiere->libelle ?? 'Formation'),
                'formateur_id'     => $affectation->formateur_id,
                'filiere_id'       => $affectation->filiere_id,
                'etablissement_id' => $affectation->etablissement_id,
                'date_debut'       => $affectation->date_debut,
                'date_fin'         => $affectation->date_fin ?? now()->addMonths(6),
                'nb_places'        => 0,
                'statut'           => $formateur->statut ?? SessionModel::STATUT_ACTIF,
            ]);
        }
    }

    public function updated(AffectationModel $affectation): void
    {
        // Synchroniser la session
        $session = SessionModel::where('formateur_id', $affectation->formateur_id)->latest()->first();

        if ($session) {
            $session->update([
                'date_debut' => $affectation->date_debut,
                'date_fin'   => $affectation->date_fin,
                'statut'     => $affectation->statut,
            ]);
        }
    }

    public function deleted(AffectationModel $affectation): void
    {
        SessionModel::where('formateur_id', $affectation->formateur_id)->delete();
    }
}
```

## app/Observers/FormateurObserver.php

```php
<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurObserver
{
    /**
     * Quand le statut du formateur change → propager partout.
     */
    public function updated(FormateurModel $formateur): void
    {
        if ($formateur->wasChanged('statut')) {
            $formateur->propagerStatut();
        }
    }

    /**
     * Quand un formateur est créé → propager son statut initial.
     */
    public function created(FormateurModel $formateur): void
    {
        // Pas besoin de propager à la création (pas d'entités liées)
    }
}
```

## app/Providers/AppServiceProvider.php

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use App\Observers\AffectationObserver;
use App\Observers\FormateurObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination Tailwind
        Paginator::useTailwind();

        // Observers
        AffectationModel::observe(AffectationObserver::class);
        FormateurModel::observe(FormateurObserver::class);
    }
}
```

## app/Providers/AuthServiceProvider.php

```php
<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        //
    ];

    public function boot(): void
    {
        //
    }
}
```

## app/Providers/HexagonalServiceProvider.php

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Domain\Formateurs\Ports\FormateurRepositoryInterface;
use Domain\Auth\Ports\PasswordHasherInterface;
use Infrastructure\Services\PdfExporterInterface;

use Infrastructure\Persistence\Eloquent\Repositories\EloquentFormateurRepository;
use Infrastructure\Adapters\Hashing\BcryptPasswordHasher;
use Infrastructure\Adapters\Pdf\DompdfExporter;

class HexagonalServiceProvider extends ServiceProvider
{
    public array $bindings = [
        FormateurRepositoryInterface::class => EloquentFormateurRepository::class,
        PasswordHasherInterface::class => BcryptPasswordHasher::class,
        PdfExporterInterface::class => DompdfExporter::class,
    ];

    public function register(): void {}
    public function boot(): void {}
}
```

## artisan

```txt
#!/usr/bin/env php
<?php

use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the command...
/** @var Application $app */
$app = require_once __DIR__.'/bootstrap/app.php';

$status = $app->handleCommand(new ArgvInput);

exit($status);
```

## bootstrap/app.php

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/auth.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
            Route::middleware('web')->group(base_path('routes/formateur.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'formateur' => \App\Http\Middleware\FormateurMiddleware::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAdmin::class,
            'guest.formateur' => \App\Http\Middleware\RedirectIfFormateur::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }
            if ($request->is('formateur/*') || $request->is('formateur')) {
                return route('formateur.login');
            }
            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

## bootstrap/providers.php

```php
<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\HexagonalServiceProvider::class,
];
```

## composer.json

```json
{
    "$schema": "https://getcomposer.org/schema.json",
    "name": "laravel/laravel",
    "type": "project",
    "description": "The skeleton application for the Laravel framework.",
    "keywords": ["laravel", "framework"],
    "license": "MIT",
    "require": {
        "php": "^8.2",
        "barryvdh/laravel-dompdf": "^3.1",
        "laravel/framework": "^12.0",
        "laravel/tinker": "^2.10.1"
    },
    "require-dev": {
        "fakerphp/faker": "^1.23",
        "laravel/pail": "^1.2.2",
        "laravel/pint": "^1.24",
        "laravel/sail": "^1.41",
        "mockery/mockery": "^1.6",
        "nunomaduro/collision": "^8.6",
        "phpunit/phpunit": "^11.5.50"
    },
   "autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/",
        "Domain\\": "app/Domain/",
        "Application\\": "app/Application/",
        "Infrastructure\\": "app/Infrastructure/"
    }
 },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "setup": [
            "composer install",
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\"",
            "@php artisan key:generate",
            "@php artisan migrate --force",
            "npm install",
            "npm run build"
        ],
        "dev": [
            "Composer\\Config::disableProcessTimeout",
            "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others"
        ],
        "test": [
            "@php artisan config:clear --ansi",
            "@php artisan test"
        ],
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi",
            "@php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\"",
            "@php artisan migrate --graceful --ansi"
        ],
        "pre-package-uninstall": [
            "Illuminate\\Foundation\\ComposerScripts::prePackageUninstall"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
```

## config/app.php

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
```

## config/auth.php

```php
<?php

use App\Models\User;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'formateur' => [
            'driver' => 'session',
            'provider' => 'formateurs_users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => AdminModel::class,
        ],
        'formateurs_users' => [
            'driver' => 'eloquent',
            'model' => FormateurUserModel::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'formateurs' => [
            'provider' => 'formateurs_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
```

## config/cache.php

```php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */

    'default' => env('CACHE_STORE', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    | Supported drivers: "array", "database", "file", "memcached",
    |                    "redis", "dynamodb", "octane",
    |                    "failover", "null"
    |
    */

    'stores' => [

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_CACHE_CONNECTION'),
            'table' => env('DB_CACHE_TABLE', 'cache'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
            'lock_table' => env('DB_CACHE_LOCK_TABLE'),
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
            'lock_path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
            'lock_connection' => env('REDIS_CACHE_LOCK_CONNECTION', 'default'),
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],

        'failover' => [
            'driver' => 'failover',
            'stores' => [
                'database',
                'array',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing the APC, database, memcached, Redis, and DynamoDB cache
    | stores, there might be other applications using the same cache. For
    | that reason, you may prefix every cache key to avoid collisions.
    |
    */

    'prefix' => env('CACHE_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-cache-'),

];
```

## config/database.php

```php
<?php

use Illuminate\Support\Str;
use Pdo\Mysql;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlite'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => env('DB_SSLMODE', 'prefer'),
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];
```

## config/filesystems.php

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => rtrim(env('APP_URL', 'http://localhost'), '/').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
```

## config/hexagonal.php

```php

```

## config/logging.php

```php
<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that is utilized to write
    | messages to your logs. The value provided here should match one of
    | the channels present in the list of "channels" configured below.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Laravel
    | utilizes the Monolog PHP logging library, which includes a variety
    | of powerful log handlers and formatters that you're free to use.
    |
    | Available drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog", "custom", "stack"
    |
    */

    'channels' => [

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', (string) env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', env('APP_NAME', 'Laravel')),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'handler_with' => [
                'stream' => 'php://stderr',
            ],
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'processors' => [PsrLogMessageProcessor::class],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];
```

## config/mail.php

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers that can be used
    | when delivering an email. You may specify which one you're using for
    | your mailers below. You may also add additional mailers if needed.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |            "postmark", "resend", "log", "array",
    |            "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all emails sent by your application to be sent from
    | the same address. Here you may specify a name and address that is
    | used globally for all emails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', env('APP_NAME', 'Laravel')),
    ],

];
```

## config/queue.php

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue supports a variety of backends via a single, unified
    | API, giving you convenient access to each backend using identical
    | syntax for each. The default queue connection is defined below.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection options for every queue backend
    | used by your application. An example configuration is provided for
    | each backend supported by Laravel. You're also free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis",
    |          "deferred", "background", "failover", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90),
            'after_commit' => false,
        ],

        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

        'deferred' => [
            'driver' => 'deferred',
        ],

        'background' => [
            'driver' => 'background',
        ],

        'failover' => [
            'driver' => 'failover',
            'connections' => [
                'database',
                'deferred',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching
    |--------------------------------------------------------------------------
    |
    | The following options configure the database and table that store job
    | batching information. These options can be updated to any database
    | connection and table which has been defined by your application.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control how and where failed jobs are stored. Laravel ships with
    | support for storing failed jobs in a simple file or in a database.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
```

## config/services.php

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
```

## config/session.php

```php
<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option determines the default session driver that is utilized for
    | incoming requests. Laravel supports a variety of storage options to
    | persist session data. Database storage is a great default choice.
    |
    | Supported: "file", "cookie", "database", "memcached",
    |            "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the session
    | to be allowed to remain idle before it expires. If you want them
    | to expire immediately when the browser is closed then you may
    | indicate that via the expire_on_close configuration option.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it's stored. All encryption is performed
    | automatically by Laravel and you may use the session like normal.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When utilizing the "file" session driver, the session files are placed
    | on disk. The default storage location is defined here; however, you
    | are free to provide another location where they should be stored.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to manage these sessions. This should
    | correspond to a connection in your database configuration options.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table to
    | be used to store sessions. Of course, a sensible default is defined
    | for you; however, you're welcome to change this to another table.
    |
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | When using one of the framework's cache driven session backends, you may
    | define the cache store which should be used to store the session data
    | between requests. This must match one of your defined cache stores.
    |
    | Affects: "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their storage location to get
    | rid of old sessions from storage. Here are the chances that it will
    | happen on a given request. By default, the odds are 2 out of 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the session cookie that is created by
    | the framework. Typically, you should not need to change this value
    | since doing so does not grant a meaningful security improvement.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug((string) env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application, but you're free to change this when necessary.
    |
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | This value determines the domain and subdomains the session cookie is
    | available to. By default, the cookie will be available to the root
    | domain without subdomains. Typically, this shouldn't be changed.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, session cookies will only be sent back
    | to the server if the browser has a HTTPS connection. This will keep
    | the cookie from being sent to you when it can't be done securely.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will prevent JavaScript from accessing the
    | value of the cookie and the cookie will only be accessible through
    | the HTTP protocol. It's unlikely you should disable this option.
    |
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | will set this value to "lax" to permit secure cross-site requests.
    |
    | See: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value
    |
    | Supported: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will tie the cookie to the top-level site for
    | a cross-site context. Partitioned cookies are accepted by the browser
    | when flagged "secure" and the Same-Site attribute is set to "none".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
```

## database/.gitignore

```gitignore
*.sqlite*
```

## database/factories/AdminFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;

class AdminFactory extends Factory
{
    protected $model = AdminModel::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ];
    }
}
```

## database/factories/EtablissementFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;

class EtablissementFactory extends Factory
{
    protected $model = EtablissementModel::class;

    public function definition(): array
    {
        return [
            'code' => 'ETB-' . $this->faker->unique()->numberBetween(100, 999),
            'nom' => 'Établissement ' . $this->faker->city(),
            'type' => $this->faker->randomElement(['CFP', 'LTP', 'Lycee', 'Autre']),
            'region' => $this->faker->city(),
            'adresse' => $this->faker->address(),
            'telephone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
```

## database/factories/FiliereFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class FiliereFactory extends Factory
{
    protected $model = FiliereModel::class;

    public function definition(): array
    {
        return [
            'code' => 'FIL-' . $this->faker->unique()->numberBetween(100, 999),
            'libelle' => $this->faker->sentence(3),
            'niveau_id' => NiveauModel::factory(),
            'secteur_id' => SecteurModel::factory(),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}
```

## database/factories/FormateurFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class FormateurFactory extends Factory
{
    protected $model = FormateurModel::class;

    public function definition(): array
    {
        return [
            'matricule' => 'FORM-' . $this->faker->unique()->numberBetween(100, 999),
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'sexe' => $this->faker->randomElement(['Masculin', 'Feminin']),
            'date_naissance' => $this->faker->date('Y-m-d', '-25 years'),
            'lieu_naissance' => $this->faker->city(),
            'cin' => strtoupper($this->faker->bothify('??######')),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'fonction' => $this->faker->randomElement(['Formateur', 'Formateur principal', 'Chef de département']),
            'grade' => $this->faker->randomElement(['P1', 'P2', 'P3', 'P4']),
            'date_recrutement' => $this->faker->date('Y-m-d', '-5 years'),
            'statut' => 'actif',
        ];
    }
}
```

## database/factories/FormateurUserFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;

class FormateurUserFactory extends Factory
{
    protected $model = FormateurUserModel::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'matricule' => 'FORM-' . $this->faker->unique()->numberBetween(100, 999),
            'telephone' => $this->faker->phoneNumber(),
            'statut' => 'actif',
            'email_verified_at' => now(),
        ];
    }
}
```

## database/factories/NiveauFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\NiveauModel;

class NiveauFactory extends Factory
{
    protected $model = NiveauModel::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'libelle' => $this->faker->sentence(2),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
```

## database/factories/SecteurFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\SecteurModel;

class SecteurFactory extends Factory
{
    protected $model = SecteurModel::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'libelle' => strtoupper($this->faker->word()),
        ];
    }
}
```

## database/factories/SessionFactory.php

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Persistence\Eloquent\Models\EtablissementModel;
use Infrastructure\Persistence\Eloquent\Models\FiliereModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class SessionFactory extends Factory
{
    protected $model = SessionModel::class;

    public function definition(): array
    {
        return [
            'code' => 'SESS-' . $this->faker->unique()->numberBetween(1000, 9999),
            'titre' => 'Session ' . $this->faker->words(3, true),
            'filiere_id' => FiliereModel::factory(),
            'formateur_id' => FormateurModel::factory(),
            'etablissement_id' => EtablissementModel::factory(),
            'date_debut' => now()->addDays(10),
            'date_fin' => now()->addMonths(3),
            'nb_places' => $this->faker->numberBetween(10, 30),
            'description' => $this->faker->optional()->paragraph(),
            'statut' => 'active',
        ];
    }
}
```

## database/factories/UserFactory.php

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
```

## database/migrations/0001_01_01_000000_create_users_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
```

## database/migrations/0001_01_01_000001_create_cache_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration')->index();
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
```

## database/migrations/0001_01_01_000002_create_jobs_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
```

## database/migrations/2024_01_01_000001_create_admins_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['super_admin', 'admin', 'gestionnaire'])->default('admin');
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
```

## database/migrations/2024_01_01_000002_create_formateurs_users_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formateurs_users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('matricule')->unique();
            $table->string('telephone')->nullable();
            $table->foreignId('etablissement_id')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('statut', ['actif', 'inactif', 'en_attente'])->default('en_attente');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateurs_users');
    }
};
```

## database/migrations/2024_01_01_000003_create_niveaux_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('libelle');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
```

## database/migrations/2024_01_01_000004_create_secteurs_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('secteurs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('libelle');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secteurs');
    }
};
```

## database/migrations/2024_01_01_000005_create_filieres_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filieres', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('libelle');
            $table->foreignId('niveau_id')->constrained('niveaux')->cascadeOnDelete();
            $table->foreignId('secteur_id')->constrained('secteurs')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};
```

## database/migrations/2024_01_01_000006_create_etablissements_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->enum('type', ['CFP', 'LTP', 'Lycee', 'Autre'])->default('CFP');
            $table->string('region')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
```

## database/migrations/2024_01_01_000007_create_formateurs_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 50)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('cin', 50)->nullable();
            $table->string('email')->unique();
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('fonction')->nullable();
            $table->string('grade', 50)->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->enum('statut', ['actif', 'inactif', 'en_attente'])->default('actif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};
```

## database/migrations/2024_01_01_000008_create_formateur_filieres_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formateur_filieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateur_filieres');
    }
};
```

## database/migrations/2024_01_01_000009_create_affectations_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['actif', 'termine', 'suspendu'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
```

## database/migrations/2024_01_01_000010_create_sessions_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('titre')->nullable();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_places')->default(0);
            $table->text('description')->nullable();
            $table->enum('statut', ['active', 'terminee', 'annulee'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations_sessions');
    }
};
```

## database/migrations/2024_01_01_000012_create_filiere_options_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filiere_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->string('libelle');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filiere_options');
    }
};
```

## database/migrations/2026_09_17_122707_create_notifications_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
```

## database/migrations/2026_09_17_134108_fix_notifications_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('titre');
            $table->text('message');
            $table->enum('type', ['info', 'success', 'warning', 'danger'])->default('info');
            $table->string('icone')->default('notifications');
            $table->boolean('lu')->default(false);
            $table->string('lien')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->index(['lu', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
```

## database/migrations/2026_09_17_135508_drop_presences_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('presences');
    }

    public function down(): void
    {
        // Non réversible
    }
};
```

## database/migrations/2026_09_17_135743_add_indexes_to_tables.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Index formateurs
        Schema::table('formateurs', function (Blueprint $table) {
            $table->index('nom', 'idx_formateurs_nom');
            $table->index('prenom', 'idx_formateurs_prenom');
            $table->index('statut', 'idx_formateurs_statut');
            $table->index('etablissement_id', 'idx_formateurs_etab');
        });

        // Index affectations
        Schema::table('affectations', function (Blueprint $table) {
            $table->index('statut', 'idx_affectations_statut');
            $table->index('date_debut', 'idx_affectations_debut');
            $table->index('formateur_id', 'idx_affectations_formateur');
            $table->index('etablissement_id', 'idx_affectations_etab');
            $table->index('filiere_id', 'idx_affectations_filiere');
        });

        // Index formations_sessions
        Schema::table('formations_sessions', function (Blueprint $table) {
            $table->index('statut', 'idx_sessions_statut');
            $table->index('date_debut', 'idx_sessions_debut');
            $table->index('date_fin', 'idx_sessions_fin');
            $table->index('formateur_id', 'idx_sessions_formateur');
        });

        // Index etablissements
        Schema::table('etablissements', function (Blueprint $table) {
            $table->index('nom', 'idx_etablissements_nom');
            $table->index('type', 'idx_etablissements_type');
        });

        // Index filieres
        Schema::table('filieres', function (Blueprint $table) {
            $table->index('libelle', 'idx_filieres_libelle');
            $table->index('niveau_id', 'idx_filieres_niveau');
            $table->index('secteur_id', 'idx_filieres_secteur');
        });
    }

    public function down(): void
    {
        Schema::table('formateurs', function (Blueprint $table) {
            $table->dropIndex('idx_formateurs_nom');
            $table->dropIndex('idx_formateurs_prenom');
            $table->dropIndex('idx_formateurs_statut');
            $table->dropIndex('idx_formateurs_etab');
        });

        Schema::table('affectations', function (Blueprint $table) {
            $table->dropIndex('idx_affectations_statut');
            $table->dropIndex('idx_affectations_debut');
            $table->dropIndex('idx_affectations_formateur');
            $table->dropIndex('idx_affectations_etab');
            $table->dropIndex('idx_affectations_filiere');
        });

        Schema::table('formations_sessions', function (Blueprint $table) {
            $table->dropIndex('idx_sessions_statut');
            $table->dropIndex('idx_sessions_debut');
            $table->dropIndex('idx_sessions_fin');
            $table->dropIndex('idx_sessions_formateur');
        });

        Schema::table('etablissements', function (Blueprint $table) {
            $table->dropIndex('idx_etablissements_nom');
            $table->dropIndex('idx_etablissements_type');
        });

        Schema::table('filieres', function (Blueprint $table) {
            $table->dropIndex('idx_filieres_libelle');
            $table->dropIndex('idx_filieres_niveau');
            $table->dropIndex('idx_filieres_secteur');
        });
    }
};
```

## database/migrations/2026_09_19_000001_add_matricule_seq_to_formateurs_table.php

```php
﻿<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matricule_sequences', function (Blueprint $table) {
            $table->id();
            $table->year('annee')->unique();
            $table->integer('derniere_valeur')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matricule_sequences');
    }
};
```

## database/migrations/2026_09_19_000002_make_niveau_secteur_nullable_in_filieres.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // Sauvegarder les données
            $filieres = DB::table('filieres')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('filieres');

            Schema::create('filieres', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('libelle');
                $table->unsignedBigInteger('niveau_id')->nullable();
                $table->unsignedBigInteger('secteur_id')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer les données
            foreach ($filieres as $f) {
                DB::table('filieres')->insert([
                    'id'          => $f->id,
                    'code'        => $f->code,
                    'libelle'     => $f->libelle,
                    'niveau_id'   => null,
                    'secteur_id'  => null,
                    'description' => $f->description,
                    'created_at'  => $f->created_at,
                    'updated_at'  => $f->updated_at,
                ]);
            }
        } else {
            Schema::table('filieres', function (Blueprint $table) {
                $table->unsignedBigInteger('niveau_id')->nullable()->change();
                $table->unsignedBigInteger('secteur_id')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};
```

## database/migrations/2026_09_19_000003_add_contact_responsable_to_etablissements_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (!Schema::hasColumn('etablissements', 'contact_responsable')) {
                $table->string('contact_responsable', 150)
                      ->nullable()
                      ->after('telephone');
            }
        });
    }

    public function down(): void
    {
        Schema::table('etablissements', function (Blueprint $table) {
            if (Schema::hasColumn('etablissements', 'contact_responsable')) {
                $table->dropColumn('contact_responsable');
            }
        });
    }
};
```

## database/migrations/2026_09_19_121135_drop_matricule_sequences_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('matricule_sequences');
    }

    public function down(): void
    {
        // Pas de rollback
    }
};
```

## database/migrations/2026_09_19_122450_update_sessions_statut_and_periode.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('formations_sessions', 'expire_le')) {
            Schema::table('formations_sessions', function (Blueprint $table) {
                $table->datetime('expire_le')->nullable()->after('statut');
            });
        }
    }

    public function down(): void
    {
        Schema::table('formations_sessions', function (Blueprint $table) {
            if (Schema::hasColumn('formations_sessions', 'expire_le')) {
                $table->dropColumn('expire_le');
            }
        });
    }
};
```

## database/migrations/2026_09_19_183718__add_suspendu_to_formateurs_statut.php.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // Sauvegarder les données
            $formateurs = DB::table('formateurs')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('formateurs');

            Schema::create('formateurs', function (Blueprint $table) {
                $table->id();
                $table->string('matricule', 50)->unique();
                $table->string('nom', 100);
                $table->string('prenom', 100);
                $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
                $table->date('date_naissance')->nullable();
                $table->string('lieu_naissance')->nullable();
                $table->string('cin', 50)->nullable();
                $table->string('email')->unique();
                $table->string('telephone', 20)->nullable();
                $table->text('adresse')->nullable();
                $table->string('grade', 50)->nullable();
                $table->date('date_recrutement')->nullable();
                $table->string('photo')->nullable();
                $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
                $table->string('statut')->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer les données
            foreach ($formateurs as $f) {
                DB::table('formateurs')->insert([
                    'id'               => $f->id,
                    'matricule'        => $f->matricule,
                    'nom'              => $f->nom,
                    'prenom'           => $f->prenom,
                    'sexe'             => $f->sexe,
                    'date_naissance'   => $f->date_naissance,
                    'lieu_naissance'   => $f->lieu_naissance,
                    'cin'              => $f->cin,
                    'email'            => $f->email,
                    'telephone'        => $f->telephone,
                    'adresse'          => $f->adresse,
                    'grade'            => $f->grade,
                    'date_recrutement' => $f->date_recrutement,
                    'photo'            => $f->photo,
                    'etablissement_id' => $f->etablissement_id,
                    'statut'           => $f->statut,
                    'created_at'       => $f->created_at,
                    'updated_at'       => $f->updated_at,
                    'deleted_at'       => $f->deleted_at,
                ]);
            }
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};
```

## database/migrations/2026_09_19_200000__unify_statuts_v2.php

```php
﻿<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // ========== 1. RECRÉER formations_sessions SANS CHECK ==========
            $sessions = DB::table('formations_sessions')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('formations_sessions');

            Schema::create('formations_sessions', function (Blueprint $table) {
                $table->id();
                $table->string('code', 50)->unique();
                $table->string('titre')->nullable();
                $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
                $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
                $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
                $table->date('date_debut');
                $table->date('date_fin');
                $table->integer('nb_places')->default(0);
                $table->text('description')->nullable();
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->datetime('expire_le')->nullable();
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            // Restaurer + convertir les valeurs
            foreach ($sessions as $s) {
                $statut = match ($s->statut) {
                    'active'   => 'actif',
                    'terminee' => 'inactif',
                    'annulee'  => 'inactif',
                    default    => $s->statut ?? 'actif',
                };

                DB::table('formations_sessions')->insert([
                    'id'               => $s->id,
                    'code'             => $s->code,
                    'titre'            => $s->titre,
                    'filiere_id'       => $s->filiere_id,
                    'formateur_id'     => $s->formateur_id,
                    'etablissement_id' => $s->etablissement_id,
                    'date_debut'       => $s->date_debut,
                    'date_fin'         => $s->date_fin,
                    'nb_places'        => $s->nb_places,
                    'description'      => $s->description,
                    'statut'           => $statut,
                    'expire_le'        => $s->expire_le ?? null,
                    'created_at'       => $s->created_at,
                    'updated_at'       => $s->updated_at,
                ]);
            }

            // ========== 2. RECRÉER affectations SANS CHECK ==========
            $affectations = DB::table('affectations')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('affectations');

            Schema::create('affectations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
                $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
                $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
                $table->date('date_debut');
                $table->date('date_fin')->nullable();
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
            });
            Schema::enableForeignKeyConstraints();

            foreach ($affectations as $a) {
                $statut = match ($a->statut) {
                    'termine'  => 'inactif',
                    'suspendu' => 'suspendu',
                    default    => $a->statut ?? 'actif',
                };

                DB::table('affectations')->insert([
                    'id'               => $a->id,
                    'formateur_id'     => $a->formateur_id,
                    'filiere_id'       => $a->filiere_id,
                    'etablissement_id' => $a->etablissement_id,
                    'date_debut'       => $a->date_debut,
                    'date_fin'         => $a->date_fin,
                    'statut'           => $statut,
                    'created_at'       => $a->created_at,
                    'updated_at'       => $a->updated_at,
                ]);
            }

            // ========== 3. RECRÉER formateurs SANS CHECK ==========
            $formateurs = DB::table('formateurs')->get();

            Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('formateurs');

            Schema::create('formateurs', function (Blueprint $table) {
                $table->id();
                $table->string('matricule', 50)->unique();
                $table->string('nom', 100);
                $table->string('prenom', 100);
                $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
                $table->date('date_naissance')->nullable();
                $table->string('lieu_naissance')->nullable();
                $table->string('cin', 50)->nullable();
                $table->string('email')->unique();
                $table->string('telephone', 20)->nullable();
                $table->text('adresse')->nullable();
                $table->string('grade', 50)->nullable();
                $table->date('date_recrutement')->nullable();
                $table->string('photo')->nullable();
                $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
                $table->foreignId('filiere_id')->nullable()->constrained('filieres')->nullOnDelete();
                $table->string('statut', 20)->default('actif'); // actif / inactif / suspendu
                $table->timestamps();
                $table->softDeletes();
            });
            Schema::enableForeignKeyConstraints();

            foreach ($formateurs as $f) {
                $statut = match ($f->statut) {
                    'en_attente' => 'actif',
                    default      => $f->statut ?? 'actif',
                };

                DB::table('formateurs')->insert([
                    'id'               => $f->id,
                    'matricule'        => $f->matricule,
                    'nom'              => $f->nom,
                    'prenom'           => $f->prenom,
                    'sexe'             => $f->sexe,
                    'date_naissance'   => $f->date_naissance,
                    'lieu_naissance'   => $f->lieu_naissance,
                    'cin'              => $f->cin,
                    'email'            => $f->email,
                    'telephone'        => $f->telephone,
                    'adresse'          => $f->adresse,
                    'grade'            => $f->grade,
                    'date_recrutement' => $f->date_recrutement,
                    'photo'            => $f->photo,
                    'etablissement_id' => $f->etablissement_id,
                    'filiere_id'       => null,
                    'statut'           => $statut,
                    'created_at'       => $f->created_at,
                    'updated_at'       => $f->updated_at,
                    'deleted_at'       => $f->deleted_at,
                ]);
            }

            // ========== 4. REMPLIR filiere_id DEPUIS LE PIVOT ==========
            DB::statement("
                UPDATE formateurs
                SET filiere_id = (
                    SELECT filiere_id
                    FROM formateur_filieres
                    WHERE formateur_filieres.formateur_id = formateurs.id
                    LIMIT 1
                )
                WHERE filiere_id IS NULL
            ");

            // ========== 5. AJOUTER statut AUX etablissements ET filieres ==========
            if (!Schema::hasColumn('etablissements', 'statut')) {
                Schema::table('etablissements', function (Blueprint $table) {
                    $table->string('statut', 20)->default('actif')->after('email');
                });
            }

            if (!Schema::hasColumn('filieres', 'statut')) {
                Schema::table('filieres', function (Blueprint $table) {
                    $table->string('statut', 20)->default('actif')->after('description');
                });
            }
        } else {
            // MySQL : ALTER simple
            Schema::table('etablissements', function (Blueprint $table) {
                if (!Schema::hasColumn('etablissements', 'statut')) {
                    $table->string('statut', 20)->default('actif');
                }
            });
            Schema::table('filieres', function (Blueprint $table) {
                if (!Schema::hasColumn('filieres', 'statut')) {
                    $table->string('statut', 20)->default('actif');
                }
            });
            Schema::table('formateurs', function (Blueprint $table) {
                if (!Schema::hasColumn('formateurs', 'filiere_id')) {
                    $table->foreignId('filiere_id')->nullable()->after('etablissement_id')
                          ->constrained('filieres')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        // Pas de rollback
    }
};
```

## database/seeders/AdminSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@sgformateurs.mg',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('admins')->insert([
            'nom' => 'Rakoto',
            'prenom' => 'Jean',
            'email' => 'gestionnaire@sgformateurs.mg',
            'password' => Hash::make('password'),
            'role' => 'gestionnaire',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
```

## database/seeders/AffectationSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffectationSeeder extends Seeder
{
    public function run(): void
    {
        $formateurs = DB::table('formateurs')->pluck('id');
        $filieres = DB::table('filieres')->pluck('id');
        $etablissements = DB::table('etablissements')->pluck('id');

        if ($formateurs->isEmpty() || $filieres->isEmpty() || $etablissements->isEmpty()) {
            return;
        }

        foreach ($formateurs as $formateurId) {
            DB::table('affectations')->insert([
                'formateur_id' => $formateurId,
                'filiere_id' => $filieres->random(),
                'etablissement_id' => $etablissements->random(),
                'date_debut' => now()->subMonth(),
                'date_fin' => now()->addMonths(6),
                'statut' => 'actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
```

## database/seeders/DatabaseSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NiveauSeeder::class,
            SecteurSeeder::class,
            FiliereSeeder::class,
            EtablissementSeeder::class,
            AdminSeeder::class,
            FormateurSeeder::class,
        ]);
    }
}
```

## database/seeders/EtablissementSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtablissementSeeder extends Seeder
{
    public function run(): void
    {
        $etablissements = [
            ['code' => 'CFP-AMBILOBE', 'nom' => 'CFP AMBILOBE', 'type' => 'CFP'],
            ['code' => 'CFP-AMBATOFINANDRAHANA', 'nom' => 'CFP AMBATOFINANDRAHANA', 'type' => 'CFP'],
            ['code' => 'CFP-MAHAFASA', 'nom' => 'CFP MAHAFASA', 'type' => 'CFP'],
            ['code' => 'CFP-MAHAJANGA', 'nom' => 'CFP MAHAJANGA', 'type' => 'CFP'],
            ['code' => 'CFP-ANTANAMBAO', 'nom' => 'CFP ANTANAMBAO MANAMPOTSY', 'type' => 'CFP'],
            ['code' => 'CFP-FOULPOINTE', 'nom' => 'CFP FOULPOINTE', 'type' => 'CFP'],
            ['code' => 'CFP-MAROLAMBO', 'nom' => 'CFP MAROLAMBO', 'type' => 'CFP'],
            ['code' => 'CFP-BEFANDRIANA-SUD', 'nom' => 'CFP BEFANDRIANA-SUD', 'type' => 'CFP'],
            ['code' => 'CFP-EJEDA', 'nom' => 'CFP EJEDA', 'type' => 'CFP'],
            ['code' => 'CFP-MILENAKA', 'nom' => 'CFP MILENAKA', 'type' => 'CFP'],
            ['code' => 'LTP-MAHAMASINA', 'nom' => 'LTP MAHAMASINA', 'type' => 'LTP'],
            ['code' => 'LTP-MANTASOA', 'nom' => 'LTP MANTASOA', 'type' => 'LTP'],
            ['code' => 'LTP-ANTSIRANANA', 'nom' => 'LTP ANTSIRANANA', 'type' => 'LTP'],
            ['code' => 'LTP-TOAMASINA', 'nom' => 'LTP TOAMASINA', 'type' => 'LTP'],
        ];

        foreach ($etablissements as $e) {
            DB::table('etablissements')->insert(array_merge($e, [
                'region' => 'Analamanga',
                'adresse' => 'Rue principale',
                'telephone' => '02000000' . rand(10, 99),
                'email' => strtolower($e['code']) . '@metfp.mg',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
```

## database/seeders/FiliereSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        $niveaux = DB::table('niveaux')->pluck('id', 'code');
        $secteurs = DB::table('secteurs')->pluck('id', 'code');

        $filieres = [
            // ===== BAC TECHNO =====
            ['code' => 'TGI', 'libelle' => 'Technologie Génie Industriel', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TGC', 'libelle' => 'Technologie Génie Civil', 'niveau' => 'BAC', 'secteur' => 'GC'],
            ['code' => 'TTR', 'libelle' => 'Technologie Tertiaire', 'niveau' => 'BAC', 'secteur' => 'TER'],

            // ===== BAC PRO - INDUSTRIEL =====
            ['code' => 'TPFM', 'libelle' => 'Technicien productique en fabrication mécanique', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMA',  'libelle' => 'Technicien maintenance automobile', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMEL', 'libelle' => 'Technicien en électrotechnique', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'EN',   'libelle' => 'Electronicien', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TMF',  'libelle' => 'Technicien en métaux en feuilles', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TOM',  'libelle' => 'Technicien en ouvrages métalliques', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'MEMA', 'libelle' => 'Mécanicien d\'engins et matériels agricoles', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'MAE',  'libelle' => 'Mécanique auto et engin', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TFFI', 'libelle' => 'Technicien frigoriste froid industriel', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TAMB', 'libelle' => 'Technicien en art et métier bois', 'niveau' => 'BAC', 'secteur' => 'IND'],
            ['code' => 'TCNB', 'libelle' => 'Technicien en construction navale bois', 'niveau' => 'BAC', 'secteur' => 'IND'],

            // ===== BAC PRO - GENIE CIVIL =====
            ['code' => 'CCBTP', 'libelle' => 'Chef de chantier bâtiment et travaux publics', 'niveau' => 'BAC', 'secteur' => 'GC'],
            ['code' => 'PCBTP', 'libelle' => 'Chef calculateur bâtiment et travaux publics', 'niveau' => 'BAC', 'secteur' => 'GC'],

            // ===== BAC PRO - TERTIAIRE =====
            ['code' => 'CG',  'libelle' => 'Comptable gestion', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'GF',  'libelle' => 'Gestion et finance', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'SS',  'libelle' => 'Secrétaire secrétariat', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'TAC', 'libelle' => 'Technique administrative et communication', 'niveau' => 'BAC', 'secteur' => 'TER'],
            ['code' => 'ACTC','libelle' => 'Agent commercial technique commerciale', 'niveau' => 'BAC', 'secteur' => 'TER'],

            // ===== BAC PRO - AGRICOLE =====
            ['code' => 'TAG', 'libelle' => 'Technicien d\'agriculture', 'niveau' => 'BAC', 'secteur' => 'AGR'],
            ['code' => 'TEV', 'libelle' => 'Technicien d\'élevage', 'niveau' => 'BAC', 'secteur' => 'AGR'],

            // ===== BAC PRO - TOURISME =====
            ['code' => 'CPA', 'libelle' => 'Cuisine pâtissier', 'niveau' => 'BAC', 'secteur' => 'THR'],
            ['code' => 'SEQ', 'libelle' => 'Serveur qualifié', 'niveau' => 'BAC', 'secteur' => 'THR'],

            // ===== BEP =====
            ['code' => 'BEP-AGR1', 'libelle' => 'Technicien d\'Agriculture', 'niveau' => 'BEP', 'secteur' => 'AGR'],
            ['code' => 'BEP-AGR2', 'libelle' => 'Technicien d\'Elevage', 'niveau' => 'BEP', 'secteur' => 'AGR'],
            ['code' => 'BEP-ART',  'libelle' => 'Céramiste', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-GC1',  'libelle' => 'Chef d\'Equipe de Chantier', 'niveau' => 'BEP', 'secteur' => 'GC'],
            ['code' => 'BEP-GC2',  'libelle' => 'Dessinateur Métreur', 'niveau' => 'BEP', 'secteur' => 'GC'],
            ['code' => 'BEP-HAB1', 'libelle' => 'Confection', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-HAB2', 'libelle' => 'Couturier', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-HAB3', 'libelle' => 'Tailleur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND1', 'libelle' => 'Ameublement Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND2', 'libelle' => 'Charpenterie Navale Bois/PRVT', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND3', 'libelle' => 'Construction Navale Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND4', 'libelle' => 'Menuiserie Bois', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND5', 'libelle' => 'Technicien en Audio-Visuel', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND6', 'libelle' => 'Technicien en Télécommunication', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND7', 'libelle' => 'Electrotechnicien Industriel', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND8', 'libelle' => 'Fraiseur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND9', 'libelle' => 'Tourneur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND10','libelle' => 'Agent de Maintenance en Froid', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND11','libelle' => 'Imprimeur / Compositeur', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND12','libelle' => 'Installation Sanitaire et Thermique', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND13','libelle' => 'Maintenancier d\'Automobile', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND14','libelle' => 'Maintenancier d\'Engin et Mécanismes Agricoles', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND15','libelle' => 'Métaux en Feuilles', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-IND16','libelle' => 'Ouvrages Métalliques', 'niveau' => 'BEP', 'secteur' => 'IND'],
            ['code' => 'BEP-TER1', 'libelle' => 'Secrétaire', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TER2', 'libelle' => 'Comptable', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TER3', 'libelle' => 'Agent Commercial', 'niveau' => 'BEP', 'secteur' => 'TER'],
            ['code' => 'BEP-TOU1', 'libelle' => 'Chef de Partie', 'niveau' => 'BEP', 'secteur' => 'THR'],
            ['code' => 'BEP-TOU2', 'libelle' => 'Cuisine/Pâtisserie', 'niveau' => 'BEP', 'secteur' => 'THR'],
            ['code' => 'BEP-TOU3', 'libelle' => 'Restaurant Bar', 'niveau' => 'BEP', 'secteur' => 'THR'],

            // ===== CAP =====
            ['code' => 'CAP-AGR1', 'libelle' => 'Agent d\'Agriculture', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR2', 'libelle' => 'Agent d\'Elevage', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR3', 'libelle' => 'Horticulture', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR4', 'libelle' => 'Jardinier-Paysagiste', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-AGR5', 'libelle' => 'Pépiniériste', 'niveau' => 'CAP', 'secteur' => 'AGR'],
            ['code' => 'CAP-GC1',  'libelle' => 'Commis de Chantier', 'niveau' => 'CAP', 'secteur' => 'GC'],
            ['code' => 'CAP-GC2',  'libelle' => 'Commis Métreur', 'niveau' => 'CAP', 'secteur' => 'GC'],
            ['code' => 'CAP-HAB1', 'libelle' => 'Coupe-Couture-Broderie', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND1', 'libelle' => 'Ameublement Bois', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND2', 'libelle' => 'Construction Navale Bois', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND3', 'libelle' => 'Menuisier', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND4', 'libelle' => 'Electrotechnicien de Bâtiment', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-IND5', 'libelle' => 'Tôlier', 'niveau' => 'CAP', 'secteur' => 'IND'],
            ['code' => 'CAP-TER1', 'libelle' => 'Employé de Bureau', 'niveau' => 'CAP', 'secteur' => 'TER'],
            ['code' => 'CAP-TOU1', 'libelle' => 'Restauration', 'niveau' => 'CAP', 'secteur' => 'THR'],

            // ===== CFA =====
            ['code' => 'CFA-MACON',   'libelle' => 'Maçon', 'niveau' => 'CFA', 'secteur' => 'GC'],
            ['code' => 'CFA-MONTBRO', 'libelle' => 'Montage Broderie', 'niveau' => 'CFA', 'secteur' => 'IND'],
            ['code' => 'CFA-MENU',    'libelle' => 'Menuisier «Atelier et Pose»', 'niveau' => 'CFA', 'secteur' => 'IND'],
            ['code' => 'CFA-FORG',    'libelle' => 'Forgeron', 'niveau' => 'CFA', 'secteur' => 'IND'],

            // ===== CAPS =====
            ['code' => 'CAPS-CAR',  'libelle' => 'Carreleur-Finisseur-Peintre et Plâtrier', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-CHA',  'libelle' => 'Charpenterie Couvreur Bois', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-MAC',  'libelle' => 'Maçon Gros Œuvre', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-INS',  'libelle' => 'Installateur Sanitaire et Plomberie', 'niveau' => 'CAPS', 'secteur' => 'GC'],
            ['code' => 'CAPS-ELE',  'libelle' => 'Electricien de Bâtiment', 'niveau' => 'CAPS', 'secteur' => 'IND'],
            ['code' => 'CAPS-SOU',  'libelle' => 'Soudeur Métallier', 'niveau' => 'CAPS', 'secteur' => 'IND'],
        ];

        foreach ($filieres as $f) {
            DB::table('filieres')->insert([
                'code' => $f['code'],
                'libelle' => $f['libelle'],
                'niveau_id' => $niveaux[$f['niveau']],
                'secteur_id' => $secteurs[$f['secteur']],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ===== OPTIONS =====
        $options = [
            ['filiere_code' => 'TMEL',  'libelle' => 'énergie renouvelable'],
            ['filiere_code' => 'TOM',   'libelle' => 'menuiserie en aluminium'],
            ['filiere_code' => 'TFFI',  'libelle' => 'énergie renouvelable'],
            ['filiere_code' => 'TAMB',  'libelle' => 'valorisation et gestion des ressources naturelles'],
            ['filiere_code' => 'PCBTP', 'libelle' => 'Dessin assisté par ordinateur (DAO)'],
        ];

        foreach ($options as $o) {
            $filiere = DB::table('filieres')->where('code', $o['filiere_code'])->first();
            if ($filiere) {
                DB::table('filiere_options')->insert([
                    'filiere_id' => $filiere->id,
                    'libelle' => $o['libelle'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
```

## database/seeders/FormateurSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormateurSeeder extends Seeder
{
    public function run(): void
    {
        $etablissements = DB::table('etablissements')->pluck('id', 'code');

        $formateurs = [
            ['matricule' => 'FORM-001', 'nom' => 'Rakoto',  'prenom' => 'Jean',   'email' => 'jean.rakoto@metfp.mg',  'etablissement' => 'CFP-AMBILOBE'],
            ['matricule' => 'FORM-002', 'nom' => 'Rasoa',   'prenom' => 'Marie',  'email' => 'marie.rasoa@metfp.mg',  'etablissement' => 'CFP-AMBILOBE'],
            ['matricule' => 'FORM-003', 'nom' => 'Andria',  'prenom' => 'Paul',   'email' => 'paul.andria@metfp.mg',  'etablissement' => 'LTP-MAHAMASINA'],
            ['matricule' => 'FORM-004', 'nom' => 'Randria', 'prenom' => 'Sophie', 'email' => 'sophie.randria@metfp.mg','etablissement' => 'LTP-TOAMASINA'],
        ];

        foreach ($formateurs as $f) {
            $etabId = $etablissements[$f['etablissement']] ?? null;

            // 1. Compte de connexion
            DB::table('formateurs_users')->insert([
                'matricule' => $f['matricule'],
                'nom' => $f['nom'],
                'prenom' => $f['prenom'],
                'email' => $f['email'],
                'password' => Hash::make('password'),
                'etablissement_id' => $etabId,
                'statut' => 'actif',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Données métier
            DB::table('formateurs')->insert([
                'matricule' => $f['matricule'],
                'nom' => $f['nom'],
                'prenom' => $f['prenom'],
                'sexe' => 'Masculin',
                'email' => $f['email'],
                'telephone' => '034000000' . rand(1, 9),
                'etablissement_id' => $etabId,
                'fonction' => 'Formateur',
                'grade' => 'P2',
                'statut' => 'actif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
```

## database/seeders/FormateurUserSeeder.php

```php

```

## database/seeders/NiveauSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    public function run(): void
    {
        $niveaux = [
            ['code' => 'BAC',  'libelle' => 'Baccalauréat Technologique et Professionnel', 'description' => 'BAC TECHNO / BAC PRO'],
            ['code' => 'BEP',  'libelle' => 'Brevet d\'Études Professionnelles',            'description' => 'BEP'],
            ['code' => 'CAP',  'libelle' => 'Certificat d\'Aptitude Professionnelle',       'description' => 'CAP'],
            ['code' => 'CFA',  'libelle' => 'Certificat de Fin d\'Apprentissage',           'description' => 'CFA'],
            ['code' => 'CAPS', 'libelle' => 'Certificat d\'Aptitude Professionnelle Spécialisée', 'description' => 'CAPS'],
        ];

        foreach ($niveaux as $n) {
            DB::table('niveaux')->insert(array_merge($n, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
```

## database/seeders/SecteurSeeder.php

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurSeeder extends Seeder
{
    public function run(): void
    {
        $secteurs = [
            ['code' => 'IND', 'libelle' => 'INDUSTRIEL'],
            ['code' => 'GC',  'libelle' => 'GENIE CIVIL'],
            ['code' => 'TER', 'libelle' => 'TERTIAIRE'],
            ['code' => 'AGR', 'libelle' => 'AGRICOLE'],
            ['code' => 'THR', 'libelle' => 'TOURISME HÔTELLERIE RESTAURATION'],
            ['code' => 'THA', 'libelle' => 'THA'],
            ['code' => 'TIC', 'libelle' => 'TIC'],
        ];

        foreach ($secteurs as $s) {
            DB::table('secteurs')->insert(array_merge($s, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
```

## database/seeders/UserSeeder.php

```php

```

## export-lot04-final/2024_01_01_000006_create_etablissements_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nom');
            $table->enum('type', ['CFP', 'LTP', 'Lycee', 'Autre'])->default('CFP');
            $table->string('region')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
```

## export-lot04-final/2024_01_01_000007_create_formateurs_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 50)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->enum('sexe', ['Masculin', 'Feminin'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('cin', 50)->nullable();
            $table->string('email')->unique();
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('fonction')->nullable();
            $table->string('grade', 50)->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('etablissement_id')->nullable()->constrained('etablissements')->nullOnDelete();
            $table->enum('statut', ['actif', 'inactif', 'en_attente'])->default('actif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};
```

## export-lot04-final/2024_01_01_000008_create_formateur_filieres_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formateur_filieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formateur_filieres');
    }
};
```

## export-lot04-final/2024_01_01_000009_create_affectations_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['actif', 'termine', 'suspendu'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
```

## export-lot04-final/2024_01_01_000010_create_sessions_table.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('titre')->nullable();
            $table->foreignId('filiere_id')->constrained('filieres')->cascadeOnDelete();
            $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
            $table->foreignId('etablissement_id')->constrained('etablissements')->cascadeOnDelete();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('nb_places')->default(0);
            $table->text('description')->nullable();
            $table->enum('statut', ['active', 'terminee', 'annulee'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations_sessions');
    }
};
```

## export-lot04-final/AffectationModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationModel extends Model
{
    use HasFactory;

    protected $table = 'affectations';

    protected $fillable = [
        'formateur_id', 'filiere_id', 'etablissement_id',
        'date_debut', 'date_fin', 'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function formateur()
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere()
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement()
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function estActive(): bool
    {
        return $this->statut === 'actif';
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'termine';
    }

    public function estSuspendue(): bool
    {
        return $this->statut === 'suspendu';
    }
}
```

## export-lot04-final/AffectationObserver.php

```php
<?php

namespace App\Observers;

use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;

class AffectationObserver
{
    public function created(AffectationModel $affectation): void
    {
        $exists = SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->where('date_debut', $affectation->date_debut)
            ->exists();

        if (!$exists) {
            SessionModel::create([
                'code'             => SessionModel::generateNextCode(),
                'titre'            => 'Session ' . ($affectation->filiere->libelle ?? 'Formation'),
                'formateur_id'     => $affectation->formateur_id,
                'filiere_id'       => $affectation->filiere_id,
                'etablissement_id' => $affectation->etablissement_id,
                'date_debut'       => $affectation->date_debut,
                'date_fin'         => $affectation->date_fin ?? now()->addMonths(6),
                'nb_places'        => 0,
                'statut'           => SessionModel::STATUT_ACTIVE,
            ]);
        }

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }

    public function updated(AffectationModel $affectation): void
    {
        $session = SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->latest()
            ->first();

        if ($session) {
            $statutSession = match ($affectation->statut) {
                AffectationModel::STATUT_ACTIF    => SessionModel::STATUT_ACTIVE,
                AffectationModel::STATUT_SUSPENDU => SessionModel::STATUT_SUSPENDU,
                AffectationModel::STATUT_TERMINE  => SessionModel::STATUT_TERMINEE,
                default                           => SessionModel::STATUT_ACTIVE,
            };

            $session->update([
                'date_debut' => $affectation->date_debut,
                'date_fin'   => $affectation->date_fin,
                'statut'     => $statutSession,
            ]);
        }

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }

    public function deleted(AffectationModel $affectation): void
    {
        SessionModel::where('formateur_id', $affectation->formateur_id)
            ->where('filiere_id', $affectation->filiere_id)
            ->where('etablissement_id', $affectation->etablissement_id)
            ->delete();

        $formateur = FormateurModel::find($affectation->formateur_id);
        if ($formateur) {
            $formateur->recalculerStatut();
        }
    }
}
```

## export-lot04-final/AppServiceProvider.php

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use App\Observers\AffectationObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination Tailwind
        Paginator::useTailwind();

        // Observer pour création automatique des sessions
        AffectationModel::observe(AffectationObserver::class);
    }
}
```

## export-lot04-final/EtablissementModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtablissementModel extends Model
{
    protected $table = 'etablissements';

    protected $fillable = [
        'code',
        'nom',
        'type',
        'region',
        'adresse',
        'telephone',             // ancien champ conservé pour compatibilité
        'contact_responsable',   // nouveau champ
        'email',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateurs(): HasMany
    {
        return $this->hasMany(FormateurModel::class, 'etablissement_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'etablissement_id');
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'etablissement_id');
    }

    // ==================== SCOPES ====================

    /**
     * Recherche multi-champs
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('nom', 'like', "%{$term}%")
              ->orWhere('region', 'like', "%{$term}%")
              ->orWhere('adresse', 'like', "%{$term}%")
              ->orWhere('contact_responsable', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%");
        });
    }

    // ==================== ACCESSORS ====================

    /**
     * Retourne le contact responsable (nouveau champ ou fallback téléphone)
     */
    public function getContactAttribute(): ?string
    {
        return $this->contact_responsable ?? $this->telephone;
    }
}
```

## export-lot04-final/ExpireSessions.php

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Infrastructure\Persistence\Eloquent\Models\AffectationModel;
use Infrastructure\Persistence\Eloquent\Models\SessionModel;

class ExpireSessions extends Command
{
    protected $signature = 'sessions:expire';

    protected $description = 'Expire les sessions terminées et synchronise formateurs + affectations';

    public function handle(): int
    {
        $today = now()->toDateString();

        DB::beginTransaction();

        try {
            // 1. Récupérer les sessions actives expirées
            $sessionsExpirees = SessionModel::where('statut', SessionModel::STATUT_ACTIVE)
                ->whereNotNull('date_fin')
                ->where('date_fin', '<', $today)
                ->get();

            $count = 0;
            $formateursTouches = [];

            foreach ($sessionsExpirees as $session) {
                // a. Session → terminee
                $session->update([
                    'statut'    => SessionModel::STATUT_TERMINEE,
                    'expire_le' => now(),
                ]);

                // b. Affectation liée → termine (si elle était active)
                AffectationModel::where('formateur_id', $session->formateur_id)
                    ->where('filiere_id', $session->filiere_id)
                    ->where('etablissement_id', $session->etablissement_id)
                    ->where('statut', AffectationModel::STATUT_ACTIF)
                    ->update(['statut' => AffectationModel::STATUT_TERMINE]);

                if ($session->formateur_id) {
                    $formateursTouches[$session->formateur_id] = true;
                }

                $count++;
            }

            // 2. Recalculer le statut de chaque formateur touché
            foreach (array_keys($formateursTouches) as $formateurId) {
                $formateur = \Infrastructure\Persistence\Eloquent\Models\FormateurModel::find($formateurId);
                if ($formateur) {
                    $formateur->recalculerStatut();
                }
            }

            DB::commit();

            $this->info("✅ {$count} session(s) expirée(s).");
            $this->info("✅ " . count($formateursTouches) . " formateur(s) recalculé(s).");

            return self::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Erreur : " . $e->getMessage());
            return self::FAILURE;
        }
    }
}
```

## export-lot04-final/FiliereModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereModel extends Model
{
    protected $table = 'filieres';

    protected $fillable = [
        'code',
        'libelle',
        'niveau_id',
        'secteur_id',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    /**
     * Niveau (optionnel — nullable depuis suppression UI)
     */
    public function niveau(): BelongsTo
    {
        return $this->belongsTo(NiveauModel::class, 'niveau_id');
    }

    /**
     * Secteur (optionnel — nullable depuis suppression UI)
     */
    public function secteur(): BelongsTo
    {
        return $this->belongsTo(SecteurModel::class, 'secteur_id');
    }

    /**
     * Options de la filière
     */
    public function options(): HasMany
    {
        return $this->hasMany(FiliereOptionModel::class, 'filiere_id');
    }

    /**
     * Formateurs liés à cette filière (via table pivot)
     */
    public function formateurs(): BelongsToMany
    {
        return $this->belongsToMany(
            FormateurModel::class,
            'formateur_filieres',
            'filiere_id',
            'formateur_id'
        )->withTimestamps();
    }

    /**
     * Affectations liées à cette filière
     */
    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'filiere_id');
    }

    /**
     * Sessions liées à cette filière
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'filiere_id');
    }

    // ==================== SCOPES ====================

    /**
     * Recherche par code ou libellé
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('libelle', 'like', "%{$term}%");
        });
    }
}
```

## export-lot04-final/FormateurModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormateurModel extends Model
{
    use SoftDeletes;

    protected $table = 'formateurs';

    // ==================== STATUTS ====================
    public const STATUT_ACTIF     = 'actif';
    public const STATUT_INACTIF   = 'inactif';
    public const STATUT_SUSPENDU  = 'suspendu';

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_INACTIF,
        self::STATUT_SUSPENDU,
    ];

    protected $fillable = [
        'matricule', 'nom', 'prenom', 'sexe', 'date_naissance',
        'lieu_naissance', 'cin', 'email', 'telephone', 'adresse',
        'grade', 'date_recrutement', 'photo', 'etablissement_id', 'statut',
    ];

    protected $casts = [
        'date_naissance'   => 'date',
        'date_recrutement' => 'date',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
        'deleted_at'       => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    public function filieres(): BelongsToMany
    {
        return $this->belongsToMany(
            FiliereModel::class,
            'formateur_filieres',
            'formateur_id',
            'filiere_id'
        )->withTimestamps();
    }

    public function affectations(): HasMany
    {
        return $this->hasMany(AffectationModel::class, 'formateur_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(SessionModel::class, 'formateur_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nom', 'like', "%{$term}%")
              ->orWhere('prenom', 'like', "%{$term}%")
              ->orWhere('matricule', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('telephone', 'like', "%{$term}%");
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', self::STATUT_ACTIF);
    }

    public function scopeInactif($query)
    {
        return $query->where('statut', self::STATUT_INACTIF);
    }

    public function scopeSuspendu($query)
    {
        return $query->where('statut', self::STATUT_SUSPENDU);
    }

    // ==================== MATRICULE AUTO ====================

    public static function generateNextMatricule(): string
    {
        $prefix = 'FORM-';

        $last = self::withTrashed()
            ->where('matricule', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(matricule, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('matricule');

        $numero = $last ? (int) substr($last, strlen($prefix)) + 1 : 1;

        return sprintf('%s%03d', $prefix, $numero);
    }

    // ==================== SYNCHRONISATION STATUT ====================

    /**
     * Recalcule le statut du formateur selon ses sessions.
     *
     * Priorité (du plus fort au plus faible) :
     * 1. Si AU MOINS UNE session est suspendue → SUSPENDU
     * 2. Sinon, si AU MOINS UNE session est active ET non expirée → ACTIF
     * 3. Sinon → INACTIF
     */
    public function recalculerStatut(): void
    {
        // 1. Vérifier s'il y a une session suspendue en cours
        $aSuspendu = $this->sessions()
            ->where('statut', SessionModel::STATUT_SUSPENDU)
            ->exists();

        if ($aSuspendu) {
            $this->update(['statut' => self::STATUT_SUSPENDU]);
            return;
        }

        // 2. Vérifier s'il y a une session active non expirée
        $aActif = $this->sessions()
            ->where('statut', SessionModel::STATUT_ACTIVE)
            ->where(function ($q) {
                $q->whereNull('date_fin')
                  ->orWhere('date_fin', '>=', now()->toDateString());
            })
            ->exists();

        // 3. Appliquer
        $nouveauStatut = $aActif
            ? self::STATUT_ACTIF
            : self::STATUT_INACTIF;

        if ($this->statut !== $nouveauStatut) {
            $this->update(['statut' => $nouveauStatut]);
        }
    }

    // ==================== HELPERS ====================

    public function estActif(): bool
    {
        return $this->statut === self::STATUT_ACTIF;
    }

    public function estInactif(): bool
    {
        return $this->statut === self::STATUT_INACTIF;
    }

    public function estSuspendu(): bool
    {
        return $this->statut === self::STATUT_SUSPENDU;
    }
}
```

## export-lot04-final/SessionModel.php

```php
<?php

namespace Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionModel extends Model
{
    protected $table = 'formations_sessions';

    protected $fillable = [
        'code',
        'titre',
        'filiere_id',
        'formateur_id',
        'etablissement_id',
        'date_debut',
        'date_fin',
        'nb_places',
        'description',
        'statut',
        'expire_le',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'expire_le'  => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ==================== RELATIONS ====================

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(FormateurModel::class, 'formateur_id');
    }

    public function filiere(): BelongsTo
    {
        return $this->belongsTo(FiliereModel::class, 'filiere_id');
    }

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo(EtablissementModel::class, 'etablissement_id');
    }

    // ==================== SCOPES ====================

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
              ->orWhere('titre', 'like', "%{$term}%")
              ->orWhereHas('formateur', function ($qq) use ($term) {
                  $qq->where('nom', 'like', "%{$term}%")
                     ->orWhere('prenom', 'like', "%{$term}%")
                     ->orWhere('matricule', 'like', "%{$term}%");
              });
        });
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'active');
    }

    public function scopeExpire($query)
    {
        return $query->where('statut', 'terminee');
    }

    // ==================== HELPERS ====================

    public function estEnCours(): bool
    {
        return $this->statut === 'active'
            && $this->date_debut <= now()
            && $this->date_fin >= now();
    }

    public function estTerminee(): bool
    {
        return $this->statut === 'terminee'
            || ($this->date_fin && $this->date_fin < now());
    }

    public function estAVenir(): bool
    {
        return $this->statut === 'active' && $this->date_debut > now();
    }

    public function estExpiree(): bool
    {
        return $this->date_fin && $this->date_fin < now();
    }

    // ==================== GÉNÉRATION CODE AUTO ====================

    /**
     * Génère un code session au format SESS-{YYYY}-{XXXX}
     */
    public static function generateNextCode(): string
    {
        $annee = (int) date('Y');
        $prefix = sprintf('SESS-%d-', $annee);

        $last = self::where('code', 'like', $prefix . '%')
            ->orderByRaw('CAST(SUBSTR(code, ' . (strlen($prefix) + 1) . ') AS INTEGER) DESC')
            ->value('code');

        if ($last) {
            $numero = (int) substr($last, strlen($prefix)) + 1;
        } else {
            $numero = 1;
        }

        return sprintf('%s%04d', $prefix, $numero);
    }
}
```

## package-lock.json

```json
{
    "name": "SGFormateurs",
    "lockfileVersion": 3,
    "requires": true,
    "packages": {
        "": {
            "devDependencies": {
                "@tailwindcss/vite": "^4.0.0",
                "axios": "^1.11.0",
                "concurrently": "^9.0.1",
                "laravel-vite-plugin": "^2.0.0",
                "tailwindcss": "^4.0.0",
                "vite": "^7.0.7"
            }
        },
        "node_modules/@esbuild/aix-ppc64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/aix-ppc64/-/aix-ppc64-0.28.2.tgz",
            "integrity": "sha512-XExcO+dvLKvVtNTibSTBej1NCAbaGhWn9Ww1ZPx80qsahhPFe/8jgWP0IchNe0F3HwkU7n8ejhH8bjonqht8mQ==",
            "cpu": [
                "ppc64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "aix"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/android-arm": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/android-arm/-/android-arm-0.28.2.tgz",
            "integrity": "sha512-kXXoiPVVGQcnIYGOeaovwOURpniDBpSq4A03qkQ+BMQqtGG6HYap3xne9C1O1yo4TR3qxlCX5IqqmX6fFo2Lqg==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/android-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/android-arm64/-/android-arm64-0.28.2.tgz",
            "integrity": "sha512-5YfKeeI8qWfBZIX+u2xZC3Zlb3Os/gLS2sbEKM+I4ZOcsWmHS2WLysCcQZDAFRslDUU5Oiq44gf6PYN1vGwG5A==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/android-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/android-x64/-/android-x64-0.28.2.tgz",
            "integrity": "sha512-O387ite7SzUyCcy3JQX4P4bLtEA7bLLkx+esve5JHnyYfNTxcVpXZo9jhdB0lTKN44gztELTdU7nS8Nr16Fs1Q==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/darwin-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/darwin-arm64/-/darwin-arm64-0.28.2.tgz",
            "integrity": "sha512-n4KqkOQrraxHJcgjM1RvwbigfQKIKJVpM7xp+KsxiyUSrRdIXnt73VhrPAx0fV44hgfmIVKjxMN9J1t5jySVkw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/darwin-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/darwin-x64/-/darwin-x64-0.28.2.tgz",
            "integrity": "sha512-uq6suIWYP37qzGddBKPw5QEQPi6HiLGsO7UmkpfyaYNQ3D+rN6w6WfwH+nuqcGXWvawGwxOEroO4YGnFh95azw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/freebsd-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/freebsd-arm64/-/freebsd-arm64-0.28.2.tgz",
            "integrity": "sha512-n+I0BTSRIoy+d6RPKnEVwql5UwBJolytvY4mAOIEJorKlqgPII8ix6slVVrfZ5Tnj7glIZvloylbB/EJPMWEXw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "freebsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/freebsd-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/freebsd-x64/-/freebsd-x64-0.28.2.tgz",
            "integrity": "sha512-78XJTJkvPs0kz2w61301PJjXl4g7q3JqiYMZ/M/yVI73EHBrCRTgkhu9oqG7vPqq+a/yadEW8aD+agKlk5xrmg==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "freebsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-arm": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-arm/-/linux-arm-0.28.2.tgz",
            "integrity": "sha512-XlDnu2q5yoqems+xay6wSAcg9DDD7K9RLKZEBOMZm3ckNpJBvOX20tSfby8KfrrhINDyv9V2YVZKY/SpoGJI8w==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-arm64/-/linux-arm64-0.28.2.tgz",
            "integrity": "sha512-pW4AC0P3it8c7do9MVM4p51FzHzdM/TZrerurgRcHJ2WTa1VQ1CIq18xncfpBJw4ojkiZZrKW2yIBWBP92j6Ug==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-ia32": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-ia32/-/linux-ia32-0.28.2.tgz",
            "integrity": "sha512-CYbnj78HsIeA+DhgUKgFCfvNsTHFhMMrinUrMZpDXJXKN8T3XViTZ/+wtHeVxEWY8ewSzTFN+nRmSwO2tZaLUQ==",
            "cpu": [
                "ia32"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-loong64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-loong64/-/linux-loong64-0.28.2.tgz",
            "integrity": "sha512-buwkd8nsph4R+ajRvw0qM5Hja/TXQow3ptzWO2EbG/cqcIkHloRrdlBtQlshyYGTNFvfkfJ5tpPLVkY4DtsPfQ==",
            "cpu": [
                "loong64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-mips64el": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-mips64el/-/linux-mips64el-0.28.2.tgz",
            "integrity": "sha512-ZVykbDyk7519VwiNb9Lcj9m8XM6v5V9uKPvrEMkkEedVewf+0itkhahp4HDpgERXhwLRpWFypsGbG/J8s0QjJA==",
            "cpu": [
                "mips64el"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-ppc64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-ppc64/-/linux-ppc64-0.28.2.tgz",
            "integrity": "sha512-CAXl+Dtd9UUuJd8pKKdwh6MLm3MUMiqMPmhZ3tTSXPqfyQ3vDl6R5hZdZ/kYojK4ofXtdfSv1tFq8XzWx3heNQ==",
            "cpu": [
                "ppc64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-riscv64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-riscv64/-/linux-riscv64-0.28.2.tgz",
            "integrity": "sha512-GeXCej4IQtU1B+QlDV8W/RRvbzI3O/Stss+/bCXv4lZls5WGRtu2a+3JkA3i4qIUlMXpcHebWpF8AkJhATowuA==",
            "cpu": [
                "riscv64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-s390x": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-s390x/-/linux-s390x-0.28.2.tgz",
            "integrity": "sha512-3H1weTYZPxt/WOhByszQZybS9w5lKzUn1FDMsgEChbHWQwHYQQRfBxgCcZvPhjHfKyJjIievvMmEUawJrdY9Dg==",
            "cpu": [
                "s390x"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/linux-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/linux-x64/-/linux-x64-0.28.2.tgz",
            "integrity": "sha512-4xTZr1FUmSoQW4XIWmit3tzQrUTZM+N3P0XV8xROKYF50XfI7xeO90+1bZvNwxIufQ9hDQVRJH5YhgPVF8A/HQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/netbsd-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/netbsd-arm64/-/netbsd-arm64-0.28.2.tgz",
            "integrity": "sha512-sSATRjPeDBg3pdgHoQfoYBob11Kk1FGa9lui5RIHZCoCkJa9QKlvl3/vKz2usCmYYjs7ymJR/2Nnsqe+Hjt5nw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "netbsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/netbsd-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/netbsd-x64/-/netbsd-x64-0.28.2.tgz",
            "integrity": "sha512-lqnzCV+mM0gIADaKihiCg6ifgfU2L3h5E33rNQBN1Y4MaVGnzryzmvvf7UHxprpQdE8hpqLolJ9Rl+SkIRDpyw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "netbsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/openbsd-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/openbsd-arm64/-/openbsd-arm64-0.28.2.tgz",
            "integrity": "sha512-AL2qJILH7lNjrDmCQDvdxMfAUIv8KMNZOvrwAQ8i8//ntL9FflhOyMJ8OZSMBb8/AWXe3/5v5S20y3zCoZWKoQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "openbsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/openbsd-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/openbsd-x64/-/openbsd-x64-0.28.2.tgz",
            "integrity": "sha512-QtiuPytchRyC4rwUKhexJdQKvDuZ6hWloi3igqPQNUJCS1/v9EiO3UTOXR6A3FoMo4fnAKbWJdqaIwhOzh8qEw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "openbsd"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/openharmony-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/openharmony-arm64/-/openharmony-arm64-0.28.2.tgz",
            "integrity": "sha512-WkhYDmpTjLvGlScA1rwjRUmhl4k8oXR3cIbtqWmELgU/dFeHHlEllxDvdWcNJV9rbzCexB5vz8gtNewWLgCT7Q==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "openharmony"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/sunos-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/sunos-x64/-/sunos-x64-0.28.2.tgz",
            "integrity": "sha512-GPMSkTOtMnv2U2F8gxe4Io6qmVs+YKyp832Etqqxr0hFngmXQ3rzwytelm3GIn7T4VviRUlf3sOgBOiTdvaf7g==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "sunos"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/win32-arm64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/win32-arm64/-/win32-arm64-0.28.2.tgz",
            "integrity": "sha512-PIhhEkE9uPBleRBrQEJpUn7MBnibZzbGzYWPmY3x+YoVg/95zbjB4CxPPOQ8l5tYYM4mMaCthF8/1DIfBQQyWQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/win32-ia32": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/win32-ia32/-/win32-ia32-0.28.2.tgz",
            "integrity": "sha512-YmJbfTlvU7Sdn9BB+4PRES4oB6pxgS37MAONj+hBr/cpXS1aBPKXxNnDbu+QCWPj0o9dgyxeq79g6c5P8KeuYA==",
            "cpu": [
                "ia32"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@esbuild/win32-x64": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/@esbuild/win32-x64/-/win32-x64-0.28.2.tgz",
            "integrity": "sha512-5ebpxr3nWMzrL/rnUI755Jkuee0bHL/Gq0WTF9lvcpv73wAp5eu8MfBUgWK9bhWvZjj7yX8etf/8tI8Ney695g==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">=18"
            }
        },
        "node_modules/@jridgewell/gen-mapping": {
            "version": "0.3.13",
            "resolved": "https://registry.npmjs.org/@jridgewell/gen-mapping/-/gen-mapping-0.3.13.tgz",
            "integrity": "sha512-2kkt/7niJ6MgEPxF0bYdQ6etZaA+fQvDcLKckhy1yIQOzaoKjBBjSj63/aLVjYE3qhRt5dvM+uUyfCg6UKCBbA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@jridgewell/sourcemap-codec": "^1.5.0",
                "@jridgewell/trace-mapping": "^0.3.24"
            }
        },
        "node_modules/@jridgewell/remapping": {
            "version": "2.3.5",
            "resolved": "https://registry.npmjs.org/@jridgewell/remapping/-/remapping-2.3.5.tgz",
            "integrity": "sha512-LI9u/+laYG4Ds1TDKSJW2YPrIlcVYOwi2fUC6xB43lueCjgxV4lffOCZCtYFiH6TNOX+tQKXx97T4IKHbhyHEQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@jridgewell/gen-mapping": "^0.3.5",
                "@jridgewell/trace-mapping": "^0.3.24"
            }
        },
        "node_modules/@jridgewell/resolve-uri": {
            "version": "3.1.2",
            "resolved": "https://registry.npmjs.org/@jridgewell/resolve-uri/-/resolve-uri-3.1.2.tgz",
            "integrity": "sha512-bRISgCIjP20/tbWSPWMEi54QVPRZExkuD9lJL+UIxUKtwVJA8wW1Trb1jMs1RFXo1CBTNZ/5hpC9QvmKWdopKw==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=6.0.0"
            }
        },
        "node_modules/@jridgewell/sourcemap-codec": {
            "version": "1.6.0",
            "resolved": "https://registry.npmjs.org/@jridgewell/sourcemap-codec/-/sourcemap-codec-1.6.0.tgz",
            "integrity": "sha512-T7jf+5zgsZHwNJ4lvQ7/aezbyk0nNX+zJVWpmHA7VYsEx7a7qr5Rg5IbtJFqkgze5Y2sruq1RUY8Q837Od7iFw==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/@jridgewell/trace-mapping": {
            "version": "0.3.31",
            "resolved": "https://registry.npmjs.org/@jridgewell/trace-mapping/-/trace-mapping-0.3.31.tgz",
            "integrity": "sha512-zzNR+SdQSDJzc8joaeP8QQoCQr8NuYx2dIIytl1QeBEZHJ9uW6hebsrYgbz8hJwUQao3TWCMtmfV8Nu1twOLAw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@jridgewell/resolve-uri": "^3.1.0",
                "@jridgewell/sourcemap-codec": "^1.4.14"
            }
        },
        "node_modules/@napi-rs/lzma-linux-x64-gnu": {
            "version": "1.5.1",
            "resolved": "https://registry.npmjs.org/@napi-rs/lzma-linux-x64-gnu/-/lzma-linux-x64-gnu-1.5.1.tgz",
            "integrity": "sha512-oTXEIha4SsuXdTA4Iyskj0kpdx2yVXdhd75c2v3xGrHFfVMsbhTPZU/nMPL4sWKo4pBHm3aucLaqGlF696dTyQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": "^22.20 || ^24.12 || >=25"
            }
        },
        "node_modules/@rollup/rollup-android-arm-eabi": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-android-arm-eabi/-/rollup-android-arm-eabi-4.63.3.tgz",
            "integrity": "sha512-w3Jnvi1ocaVm/c7yVPpfB98XeSRBMyzp6njL5MVVbGyXjpmUkN+s6Hp4t0PqhGCCaI1ZHMKXt/w0lA1RCaLVcw==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ]
        },
        "node_modules/@rollup/rollup-android-arm64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-android-arm64/-/rollup-android-arm64-4.63.3.tgz",
            "integrity": "sha512-uI/ESiaIbbRYAEhzy8PCUWDp1hB0bjAqM06mW9flOoNO4Q8DQpeoREhBR5Hegfl+wpXiguyJv6XSPzEN7OxyHQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ]
        },
        "node_modules/@rollup/rollup-darwin-arm64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-darwin-arm64/-/rollup-darwin-arm64-4.63.3.tgz",
            "integrity": "sha512-oxhrd1jmXLwWZ83eQYDXxuqRdkqkzrjR3JobKeuUyfdNZo11FuQIvqEOZhyIT7OBHxXoGslDDjN0cQcM6T0TqQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ]
        },
        "node_modules/@rollup/rollup-darwin-x64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-darwin-x64/-/rollup-darwin-x64-4.63.3.tgz",
            "integrity": "sha512-7/YiIMghVE8DrxKvNdorAaJVdriOFgOIpdStnPx8ppx5zfTwC3jBCSEAIzB7JD5404m65THl6H93UTTVUvypmg==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ]
        },
        "node_modules/@rollup/rollup-freebsd-arm64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-freebsd-arm64/-/rollup-freebsd-arm64-4.63.3.tgz",
            "integrity": "sha512-GXFZRRoMAytaI5z6N3Zhfw0WL18Q0M8r95D5hlC4GqE/lGk8pbSJNUBoOWDfbm6dTciqHj2nU87tI5f6XhQiOg==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "freebsd"
            ]
        },
        "node_modules/@rollup/rollup-freebsd-x64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-freebsd-x64/-/rollup-freebsd-x64-4.63.3.tgz",
            "integrity": "sha512-77W+8X3ddYgPxUpB8nZFQs2Mq+wc4HVlcSRtApXLjYBcnPMkttrSnU8VwKQjeWYhMsITHFs5cWBQ8vz1Q+5RHQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "freebsd"
            ]
        },
        "node_modules/@rollup/rollup-linux-arm-gnueabihf": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-arm-gnueabihf/-/rollup-linux-arm-gnueabihf-4.63.3.tgz",
            "integrity": "sha512-FVkwK+iUC+mq+GipVK46rRVticfAPtvPUNlqlGXUDxdVk/UGjQiiiUVPUrEXdSpU2ufU0XxLGyTqDtBidDOVmg==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-arm-musleabihf": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-arm-musleabihf/-/rollup-linux-arm-musleabihf-4.63.3.tgz",
            "integrity": "sha512-+aGU1t3398yQOVj1Bz8o3e+KtswxAPvO+mtxtNdfXYMkXIHu7XhhkCD7/DEH9q8tF8uhDnMWvfpUKI8y1sZJsg==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-arm64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-arm64-gnu/-/rollup-linux-arm64-gnu-4.63.3.tgz",
            "integrity": "sha512-cR0kjpRXR2KJ2oQK8E2KTPtphs+b9hZ8IhTZubNryt/RsqgdOZBQ2Zq0q5UedtiIi0rs3jVhJh55RE1ZHUVGUA==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-arm64-musl": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-arm64-musl/-/rollup-linux-arm64-musl-4.63.3.tgz",
            "integrity": "sha512-y1RYi4Q3/9ByVWSSt9kX2ustE0B7kFYbJ6zZdVZVyqopZs3yhCTwRfrjIX4vezUJInma/Gs6BOFDJg7yZmJ0IQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-loong64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-loong64-gnu/-/rollup-linux-loong64-gnu-4.63.3.tgz",
            "integrity": "sha512-DNhEA5viIj3Z5bZLE4z4oV8N5ozWqDwyt7T6KG7VdLDJ0nW+rNOYlphBl4/3HQkK75qipPLsVOfStHHOwN9WSg==",
            "cpu": [
                "loong64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-loong64-musl": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-loong64-musl/-/rollup-linux-loong64-musl-4.63.3.tgz",
            "integrity": "sha512-17gQCqrIpXBX2Cmi9/TygnVOqGbzsba/iaqcYSL8FY7lNugg+7AiYNs5c5nKWD+NRQha36Sa0CqkJqH4XVHwnQ==",
            "cpu": [
                "loong64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-ppc64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-ppc64-gnu/-/rollup-linux-ppc64-gnu-4.63.3.tgz",
            "integrity": "sha512-6LwVnZRIyINpdku/yOcI8Tm9YqLmhHK5emmlOOnW9tO0SYEm1FmKPcsSAGp0NBlqR2P04xaND4jvN6sTHqhq8A==",
            "cpu": [
                "ppc64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-ppc64-musl": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-ppc64-musl/-/rollup-linux-ppc64-musl-4.63.3.tgz",
            "integrity": "sha512-xMUqkTXlEUtI/p5AAukMwBRr1enU3efsTeF+bskeFfk8t1C9rcC8sLREcZXmTfAXEbvRdJVSonVJez3TMlbR3w==",
            "cpu": [
                "ppc64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-riscv64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-riscv64-gnu/-/rollup-linux-riscv64-gnu-4.63.3.tgz",
            "integrity": "sha512-S3E94co9F9WRRqEaUoQZ38K1gCz6KiM+nL7/3ijq7fDGF3OznjS5TasgYITlvl27GQKtu4lOAOsr5MFwkijvOA==",
            "cpu": [
                "riscv64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-riscv64-musl": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-riscv64-musl/-/rollup-linux-riscv64-musl-4.63.3.tgz",
            "integrity": "sha512-1QtRDwG42x5BJI3s9mxu5rEjDnfbSnk20HQ9/ylTAYnSwYwxMVb+Vgu34wzzTQ7ogqBybebgQNUDAvZVQ38DbA==",
            "cpu": [
                "riscv64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-s390x-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-s390x-gnu/-/rollup-linux-s390x-gnu-4.63.3.tgz",
            "integrity": "sha512-BQhejF6ZXOpxbngiNTP12GCGQeaDVL2QXGeBVViKIYzFHM5RKxTxwUMB1fr1BeNFphFMpnRqC5QSXFSa4z6UQw==",
            "cpu": [
                "s390x"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-x64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-x64-gnu/-/rollup-linux-x64-gnu-4.63.3.tgz",
            "integrity": "sha512-SXagRwnI2Wlwlitllu59UK/nGVbD1CKPcNqDplHwIC4BqJcpXFjD32d1R/RbuISa95HdQrZM3/7v4bKiowFaLA==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-linux-x64-musl": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-linux-x64-musl/-/rollup-linux-x64-musl-4.63.3.tgz",
            "integrity": "sha512-2IPozoEALRCziGqE8O9KMK60PMu5TS1huv4fwoeCexj+WjmcwFtX9CTOVbfXCUqcELAubEwRFPYlzb/WvwY2HQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ]
        },
        "node_modules/@rollup/rollup-openbsd-x64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-openbsd-x64/-/rollup-openbsd-x64-4.63.3.tgz",
            "integrity": "sha512-AoxqosUHT9IX54hFn2TiN6A7d6ZKTtE6pd2bqWtqkkNJ6HJGaU6FRouGX8L1O7R/ZwsnCnpQrHzb4pDEx+UHRQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "openbsd"
            ]
        },
        "node_modules/@rollup/rollup-openharmony-arm64": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-openharmony-arm64/-/rollup-openharmony-arm64-4.63.3.tgz",
            "integrity": "sha512-d+CaftKgmkFBzCwezMqqy1d0QNNYugqLCMcYVQWBy5SS2YfeMP8Q8ripkgx9O8IyBXXLHrJ+aaCV4U96usv6Yg==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "openharmony"
            ]
        },
        "node_modules/@rollup/rollup-win32-arm64-msvc": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-win32-arm64-msvc/-/rollup-win32-arm64-msvc-4.63.3.tgz",
            "integrity": "sha512-xXlDF6nR1eOuXbdDy5Hl5fmtY7teUDevF/k0O7IPoZe4Tpmdv+lgdE5JRsnhQtt37ql9P0VF2kAN9a0OCZdo+Q==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ]
        },
        "node_modules/@rollup/rollup-win32-ia32-msvc": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-win32-ia32-msvc/-/rollup-win32-ia32-msvc-4.63.3.tgz",
            "integrity": "sha512-YtXAgLN+JP7Ay6qG3eWhc7IHMQPzLc8r3uvhAvlJIoCz/4Q32+Bl9Fmnywidh8v1GOIMmymjovfqY9ETAtysvA==",
            "cpu": [
                "ia32"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ]
        },
        "node_modules/@rollup/rollup-win32-x64-gnu": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-win32-x64-gnu/-/rollup-win32-x64-gnu-4.63.3.tgz",
            "integrity": "sha512-WuWtSJRNo549vzcfZyEgfqb6zeSgn1F+UE5kQ+BCjzz0W4MGCjntUHkZVc1VRuAM7+ULaSyhiPxD1spyewFvkQ==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ]
        },
        "node_modules/@rollup/rollup-win32-x64-msvc": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/@rollup/rollup-win32-x64-msvc/-/rollup-win32-x64-msvc-4.63.3.tgz",
            "integrity": "sha512-+lIKX7O0+IGe7WuhATaAMMeT7B76vfhXH/l9wLQL+nvyhbw2ohYCKIdWL56JfDu75CWt5oKRP4QFH/jkMtBquA==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ]
        },
        "node_modules/@tailwindcss/node": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/node/-/node-4.3.3.tgz",
            "integrity": "sha512-/T8IKEsf9VTU6tLjgC7+sv2mOPtQxzE2jMw7u4Tt40Tx+QSZxpzh95/H6cMKoja9XuW7iMdLJYBB0o9G1CaAgg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@jridgewell/remapping": "^2.3.5",
                "enhanced-resolve": "^5.24.1",
                "jiti": "^2.7.0",
                "lightningcss": "1.32.0",
                "magic-string": "^0.30.21",
                "source-map-js": "^1.2.1",
                "tailwindcss": "4.3.3"
            }
        },
        "node_modules/@tailwindcss/oxide": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide/-/oxide-4.3.3.tgz",
            "integrity": "sha512-krXjAikiaFSPaK/FkAQT5UTx3VormQaiZ5hBFlJZ9UFQGB/rwg1MZIhHAG9smMQRTdyJxP6Qt5MwMtdyU5FWrA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 20"
            },
            "optionalDependencies": {
                "@tailwindcss/oxide-android-arm64": "4.3.3",
                "@tailwindcss/oxide-darwin-arm64": "4.3.3",
                "@tailwindcss/oxide-darwin-x64": "4.3.3",
                "@tailwindcss/oxide-freebsd-x64": "4.3.3",
                "@tailwindcss/oxide-linux-arm-gnueabihf": "4.3.3",
                "@tailwindcss/oxide-linux-arm64-gnu": "4.3.3",
                "@tailwindcss/oxide-linux-arm64-musl": "4.3.3",
                "@tailwindcss/oxide-linux-x64-gnu": "4.3.3",
                "@tailwindcss/oxide-linux-x64-musl": "4.3.3",
                "@tailwindcss/oxide-wasm32-wasi": "4.3.3",
                "@tailwindcss/oxide-win32-arm64-msvc": "4.3.3",
                "@tailwindcss/oxide-win32-x64-msvc": "4.3.3"
            }
        },
        "node_modules/@tailwindcss/oxide-android-arm64": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-android-arm64/-/oxide-android-arm64-4.3.3.tgz",
            "integrity": "sha512-Y85A2gmPSkl5Ve5qR86GL4HT509cFqQh1aes9p3sSkyTPwt0Pppf3GkwGe4JPACcRYjgJIEhQgM6dBClnr0NYw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "android"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-darwin-arm64": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-darwin-arm64/-/oxide-darwin-arm64-4.3.3.tgz",
            "integrity": "sha512-BiaWatpBcERQFDlOjRDpIVXuFK5PJez5SA4JMg6VYZdBYU+qKfV/vqjcIs+IYmtitf1xYQZTwXvU/8y4lfZUGw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-darwin-x64": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-darwin-x64/-/oxide-darwin-x64-4.3.3.tgz",
            "integrity": "sha512-fAeUqfV5ndhxRwai8cXGzdLvul9utWOmeTkv69unv4ZXixjn61Z+p9lCWdwOwA3TYboG3BwdVuN/RDjhBRl0mw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-freebsd-x64": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-freebsd-x64/-/oxide-freebsd-x64-4.3.3.tgz",
            "integrity": "sha512-iyf5bV6+wnAlflVeEy7R25dupxTNECZN5QMI0qNT6eT+EgaGdZcKhGkr5SdoaWiLJ3spLqIY9VCeSGrwmtg4kw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "freebsd"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-linux-arm-gnueabihf": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-linux-arm-gnueabihf/-/oxide-linux-arm-gnueabihf-4.3.3.tgz",
            "integrity": "sha512-aAYUprJAJQWWbRrPvtjdroZ56Md+JM8pMiopS6xGEwDfLhqj+2ver2p4nU4Mb3CRqcMmNBjo8KkUgcxhkzVQGQ==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-linux-arm64-gnu": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-linux-arm64-gnu/-/oxide-linux-arm64-gnu-4.3.3.tgz",
            "integrity": "sha512-nDxldcEENOxZRzC2uu9jrutZdAAQtb+8WWDCSnWL1zvBk1+FN+x6MtDViPB5AJMfttVCUhehGWus3XBPgatM/w==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-linux-arm64-musl": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-linux-arm64-musl/-/oxide-linux-arm64-musl-4.3.3.tgz",
            "integrity": "sha512-Md44bD6veX/PC5iyF8cDVnw4HBIANZepRZZ7a8DQOvkfo5WUBwcp6iAuCUz23u+4SUkhJlD3eL7hNdW8ezd/kA==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-linux-x64-gnu": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-linux-x64-gnu/-/oxide-linux-x64-gnu-4.3.3.tgz",
            "integrity": "sha512-tx7us1muwOKAKWao2v/GaafFeQboE6aj88vC6ziN2NCGcRm8gWUhwjzg+YdVB1e4boAtdtma4L43onunI6NS4w==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-linux-x64-musl": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-linux-x64-musl/-/oxide-linux-x64-musl-4.3.3.tgz",
            "integrity": "sha512-SJxX60smvHgasZoBy11dX6YRjXJFovwWBoedhbQPOBzgFWBHGB+TVPWB9BxzR7TTxU8FQZAI2AyiNCMzFm8Img==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MIT",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-wasm32-wasi": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-wasm32-wasi/-/oxide-wasm32-wasi-4.3.3.tgz",
            "integrity": "sha512-jx1+rPhY/5Ympkktd656HBWEBLxP7dH06losBLjjf5vgCODXvi9KhtftWcMIwTFIDqBr7cRnQkdLnAG+IOlGvQ==",
            "bundleDependencies": [
                "@napi-rs/wasm-runtime",
                "@emnapi/core",
                "@emnapi/runtime",
                "@tybys/wasm-util",
                "@emnapi/wasi-threads",
                "tslib"
            ],
            "cpu": [
                "wasm32"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "dependencies": {
                "@emnapi/core": "^1.11.1",
                "@emnapi/runtime": "^1.11.1",
                "@emnapi/wasi-threads": "^1.2.2",
                "@napi-rs/wasm-runtime": "^1.1.4",
                "@tybys/wasm-util": "^0.10.2",
                "tslib": "^2.8.1"
            },
            "engines": {
                "node": ">=14.0.0"
            }
        },
        "node_modules/@tailwindcss/oxide-win32-arm64-msvc": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-win32-arm64-msvc/-/oxide-win32-arm64-msvc-4.3.3.tgz",
            "integrity": "sha512-3rc292Ca2ceK6Ulcc/bAVnTs/3nDtoPhyEKlgPv+yQJQi/JS/AMJlqzxvlDacL1nekbrcf6bTqp/jV4qgnPxNQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/oxide-win32-x64-msvc": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/oxide-win32-x64-msvc/-/oxide-win32-x64-msvc-4.3.3.tgz",
            "integrity": "sha512-yJ0pwIVc/nYeGoV02WtsN8KYyLQv7kyI2wDnkezyJlGGjkd4QLwDGAwl47YpPJeuI0M0ObaXGSPjvWDPeTPggw==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">= 20"
            }
        },
        "node_modules/@tailwindcss/vite": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/@tailwindcss/vite/-/vite-4.3.3.tgz",
            "integrity": "sha512-yYU8cogLeSh/ms2jh8Fj7jaba/EWa7Ja6GoUqYZaraEuCI5YS6ms6ObZgjjedm+jm6XZjdNRWBpPP6Z86oOxcw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@tailwindcss/node": "4.3.3",
                "@tailwindcss/oxide": "4.3.3",
                "tailwindcss": "4.3.3"
            },
            "peerDependencies": {
                "vite": "^5.2.0 || ^6 || ^7 || ^8"
            }
        },
        "node_modules/@types/estree": {
            "version": "1.0.9",
            "resolved": "https://registry.npmjs.org/@types/estree/-/estree-1.0.9.tgz",
            "integrity": "sha512-GhdPgy1el4/ImP05X05Uw4cw2/M93BCUmnEvWZNStlCzEKME4Fkk+YpoA5OiHNQmoS7Cafb8Xa3Pya8m1Qrzeg==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/agent-base": {
            "version": "6.0.2",
            "resolved": "https://registry.npmjs.org/agent-base/-/agent-base-6.0.2.tgz",
            "integrity": "sha512-RZNwNclF7+MS/8bDg70amg32dyeZGZxiDuQmZxKLAlQjr3jGyLx+4Kkk58UO7D2QdgFIQCovuSuZESne6RG6XQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "debug": "4"
            },
            "engines": {
                "node": ">= 6.0.0"
            }
        },
        "node_modules/ansi-regex": {
            "version": "5.0.1",
            "resolved": "https://registry.npmjs.org/ansi-regex/-/ansi-regex-5.0.1.tgz",
            "integrity": "sha512-quJQXlTSUGL2LH9SUXo8VwsY4soanhgo6LNSm84E1LBcE8s3O0wpdiRzyR9z/ZZJMlMWv37qOOb9pdJlMUEKFQ==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/ansi-styles": {
            "version": "4.3.0",
            "resolved": "https://registry.npmjs.org/ansi-styles/-/ansi-styles-4.3.0.tgz",
            "integrity": "sha512-zbB9rCJAT1rbjiVDb2hqKFHNYLxgtk8NURxZ3IZwD3F6NtxbXZQCnnSi1Lkx+IDohdPlFp222wVALIheZJQSEg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "color-convert": "^2.0.1"
            },
            "engines": {
                "node": ">=8"
            },
            "funding": {
                "url": "https://github.com/chalk/ansi-styles?sponsor=1"
            }
        },
        "node_modules/asynckit": {
            "version": "0.4.0",
            "resolved": "https://registry.npmjs.org/asynckit/-/asynckit-0.4.0.tgz",
            "integrity": "sha512-Oei9OH4tRh0YqU3GxhX79dM/mwVgvbZJaSNaRk+bshkj0S5cfHcgYakreBjrHwatXKbz+IoIdYLxrKim2MjW0Q==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/axios": {
            "version": "1.20.0",
            "resolved": "https://registry.npmjs.org/axios/-/axios-1.20.0.tgz",
            "integrity": "sha512-r8aOh8j9cGKpgQAqpzrUHnSIc6a59Y3Xf/cv8sy1DrHCkZHzQGEuoq1tARk6qSyDdtQGSDgpb9kFlruzPvrgwg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "follow-redirects": "^1.16.0",
                "form-data": "^4.0.6",
                "https-proxy-agent": "^5.0.1",
                "proxy-from-env": "^2.1.0"
            }
        },
        "node_modules/call-bind-apply-helpers": {
            "version": "1.0.2",
            "resolved": "https://registry.npmjs.org/call-bind-apply-helpers/-/call-bind-apply-helpers-1.0.2.tgz",
            "integrity": "sha512-Sp1ablJ0ivDkSzjcaJdxEunN5/XvksFJ2sMBFfq6x0ryhQV/2b/KwFe21cMpmHtPOSij8K99/wSfoEuTObmuMQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "es-errors": "^1.3.0",
                "function-bind": "^1.1.2"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/chalk": {
            "version": "4.1.2",
            "resolved": "https://registry.npmjs.org/chalk/-/chalk-4.1.2.tgz",
            "integrity": "sha512-oKnbhFyRIXpUuez8iBMmyEa4nbj4IOQyuhc/wy9kY7/WVPcwIO9VA668Pu8RkO7+0G76SLROeyw9CpQ061i4mA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "ansi-styles": "^4.1.0",
                "supports-color": "^7.1.0"
            },
            "engines": {
                "node": ">=10"
            },
            "funding": {
                "url": "https://github.com/chalk/chalk?sponsor=1"
            }
        },
        "node_modules/chalk/node_modules/supports-color": {
            "version": "7.2.0",
            "resolved": "https://registry.npmjs.org/supports-color/-/supports-color-7.2.0.tgz",
            "integrity": "sha512-qpCAvRl9stuOHveKsn7HncJRvv501qIacKzQlO/+Lwxc9+0q2wLyv4Dfvt80/DPn2pqOBsJdDiogXGR9+OvwRw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "has-flag": "^4.0.0"
            },
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/cliui": {
            "version": "8.0.1",
            "resolved": "https://registry.npmjs.org/cliui/-/cliui-8.0.1.tgz",
            "integrity": "sha512-BSeNnyus75C4//NQ9gQt1/csTXyo/8Sb+afLAkzAptFuMsod9HFokGNudZpi/oQV73hnVK+sR+5PVRMd+Dr7YQ==",
            "dev": true,
            "license": "ISC",
            "dependencies": {
                "string-width": "^4.2.0",
                "strip-ansi": "^6.0.1",
                "wrap-ansi": "^7.0.0"
            },
            "engines": {
                "node": ">=12"
            }
        },
        "node_modules/color-convert": {
            "version": "2.0.1",
            "resolved": "https://registry.npmjs.org/color-convert/-/color-convert-2.0.1.tgz",
            "integrity": "sha512-RRECPsj7iu/xb5oKYcsFHSppFNnsj/52OVTRKb4zP5onXwVF3zVmmToNcOfGC+CRDpfK/U584fMg38ZHCaElKQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "color-name": "~1.1.4"
            },
            "engines": {
                "node": ">=7.0.0"
            }
        },
        "node_modules/color-name": {
            "version": "1.1.4",
            "resolved": "https://registry.npmjs.org/color-name/-/color-name-1.1.4.tgz",
            "integrity": "sha512-dOy+3AuW3a2wNbZHIuMZpTcgjGuLU/uBL/ubcZF9OXbDo8ff4O8yVp5Bf0efS8uEoYo5q4Fx7dY9OgQGXgAsQA==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/combined-stream": {
            "version": "1.0.8",
            "resolved": "https://registry.npmjs.org/combined-stream/-/combined-stream-1.0.8.tgz",
            "integrity": "sha512-FQN4MRfuJeHf7cBbBMJFXhKSDq+2kAArBlmRBvcvFE5BB1HZKXtSFASDhdlz9zOYwxh8lDdnvmMOe/+5cdoEdg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "delayed-stream": "~1.0.0"
            },
            "engines": {
                "node": ">= 0.8"
            }
        },
        "node_modules/concurrently": {
            "version": "9.2.4",
            "resolved": "https://registry.npmjs.org/concurrently/-/concurrently-9.2.4.tgz",
            "integrity": "sha512-TZ0CEhyzvFjgtAvHTusDMgj7wNdihCh7LLLrzdUOXIhdlnL2JBBGA9eJxR24rtqgmdjh3OA3hrN1rCHj6HM8qA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "chalk": "4.1.2",
                "rxjs": "7.8.2",
                "shell-quote": "1.9.0",
                "supports-color": "8.1.1",
                "tree-kill": "1.2.2",
                "yargs": "17.7.2"
            },
            "bin": {
                "conc": "dist/bin/concurrently.js",
                "concurrently": "dist/bin/concurrently.js"
            },
            "engines": {
                "node": ">=18"
            },
            "funding": {
                "url": "https://github.com/open-cli-tools/concurrently?sponsor=1"
            }
        },
        "node_modules/debug": {
            "version": "4.4.3",
            "resolved": "https://registry.npmjs.org/debug/-/debug-4.4.3.tgz",
            "integrity": "sha512-RGwwWnwQvkVfavKVt22FGLw+xYSdzARwm0ru6DhTVA3umU5hZc28V3kO4stgYryrTlLpuvgI9GiijltAjNbcqA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "ms": "^2.1.3"
            },
            "engines": {
                "node": ">=6.0"
            },
            "peerDependenciesMeta": {
                "supports-color": {
                    "optional": true
                }
            }
        },
        "node_modules/delayed-stream": {
            "version": "1.0.0",
            "resolved": "https://registry.npmjs.org/delayed-stream/-/delayed-stream-1.0.0.tgz",
            "integrity": "sha512-ZySD7Nf91aLB0RxL4KGrKHBXl7Eds1DAmEdcoVawXnLD7SDhpNgtuII2aAkg7a7QS41jxPSZ17p4VdGnMHk3MQ==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=0.4.0"
            }
        },
        "node_modules/detect-libc": {
            "version": "2.1.2",
            "resolved": "https://registry.npmjs.org/detect-libc/-/detect-libc-2.1.2.tgz",
            "integrity": "sha512-Btj2BOOO83o3WyH59e8MgXsxEQVcarkUOpEYrubB0urwnN10yQ364rsiByU11nZlqWYZm05i/of7io4mzihBtQ==",
            "dev": true,
            "license": "Apache-2.0",
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/dunder-proto": {
            "version": "1.0.1",
            "resolved": "https://registry.npmjs.org/dunder-proto/-/dunder-proto-1.0.1.tgz",
            "integrity": "sha512-KIN/nDJBQRcXw0MLVhZE9iQHmG68qAVIBg9CqmUYjmQIhgij9U5MFvrqkUL5FbtyyzZuOeOt0zdeRe4UY7ct+A==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "call-bind-apply-helpers": "^1.0.1",
                "es-errors": "^1.3.0",
                "gopd": "^1.2.0"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/emoji-regex": {
            "version": "8.0.0",
            "resolved": "https://registry.npmjs.org/emoji-regex/-/emoji-regex-8.0.0.tgz",
            "integrity": "sha512-MSjYzcWNOA0ewAHpz0MxpYFvwg6yjy1NG3xteoqz644VCo/RPgnr1/GGt+ic3iJTzQ8Eu3TdM14SawnVUmGE6A==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/enhanced-resolve": {
            "version": "5.25.1",
            "resolved": "https://registry.npmjs.org/enhanced-resolve/-/enhanced-resolve-5.25.1.tgz",
            "integrity": "sha512-nGXts5znJzmWPu+mIE9izCOzdg63oJca2mDzGWWTth7sr4aCToKcoyFVBQwN75Ij5Pf6p510EwkTqViTRzDV+w==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "graceful-fs": "^4.2.4",
                "tapable": "^2.3.3"
            },
            "engines": {
                "node": ">=10.13.0"
            }
        },
        "node_modules/es-define-property": {
            "version": "1.0.1",
            "resolved": "https://registry.npmjs.org/es-define-property/-/es-define-property-1.0.1.tgz",
            "integrity": "sha512-e3nRfgfUZ4rNGL232gUgX06QNyyez04KdjFrF+LTRoOXmrOgFKDg4BCdsjW8EnT69eqdYGmRpJwiPVYNrCaW3g==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/es-errors": {
            "version": "1.3.0",
            "resolved": "https://registry.npmjs.org/es-errors/-/es-errors-1.3.0.tgz",
            "integrity": "sha512-Zf5H2Kxt2xjTvbJvP2ZWLEICxA6j+hAmMzIlypy4xcBg1vKVnx89Wy0GbS+kf5cwCVFFzdCFh2XSCFNULS6csw==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/es-object-atoms": {
            "version": "1.1.2",
            "resolved": "https://registry.npmjs.org/es-object-atoms/-/es-object-atoms-1.1.2.tgz",
            "integrity": "sha512-HWcBoN6NileqtSydK2FqHbS/LoDd2pqrnQHLyJzBj4kOp/ky2MWMN694xOfkK8/SnUsW2DH7EfyVlydKCsm1Zw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "es-errors": "^1.3.0"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/es-set-tostringtag": {
            "version": "2.1.0",
            "resolved": "https://registry.npmjs.org/es-set-tostringtag/-/es-set-tostringtag-2.1.0.tgz",
            "integrity": "sha512-j6vWzfrGVfyXxge+O0x5sh6cvxAog0a/4Rdd2K36zCMV5eJ+/+tOAngRO8cODMNWbVRdVlmGZQL2YS3yR8bIUA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "es-errors": "^1.3.0",
                "get-intrinsic": "^1.2.6",
                "has-tostringtag": "^1.0.2",
                "hasown": "^2.0.2"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/esbuild": {
            "version": "0.28.2",
            "resolved": "https://registry.npmjs.org/esbuild/-/esbuild-0.28.2.tgz",
            "integrity": "sha512-HKVLS8dvII+xoKW9kmqxbRKrnWEXfJJr/FZhhJmiqIB0e053QNYFqOBouTMO/k5sID4MvCiUCvv8b9M4h32wIA==",
            "dev": true,
            "hasInstallScript": true,
            "license": "MIT",
            "bin": {
                "esbuild": "bin/esbuild"
            },
            "engines": {
                "node": ">=18"
            },
            "optionalDependencies": {
                "@esbuild/aix-ppc64": "0.28.2",
                "@esbuild/android-arm": "0.28.2",
                "@esbuild/android-arm64": "0.28.2",
                "@esbuild/android-x64": "0.28.2",
                "@esbuild/darwin-arm64": "0.28.2",
                "@esbuild/darwin-x64": "0.28.2",
                "@esbuild/freebsd-arm64": "0.28.2",
                "@esbuild/freebsd-x64": "0.28.2",
                "@esbuild/linux-arm": "0.28.2",
                "@esbuild/linux-arm64": "0.28.2",
                "@esbuild/linux-ia32": "0.28.2",
                "@esbuild/linux-loong64": "0.28.2",
                "@esbuild/linux-mips64el": "0.28.2",
                "@esbuild/linux-ppc64": "0.28.2",
                "@esbuild/linux-riscv64": "0.28.2",
                "@esbuild/linux-s390x": "0.28.2",
                "@esbuild/linux-x64": "0.28.2",
                "@esbuild/netbsd-arm64": "0.28.2",
                "@esbuild/netbsd-x64": "0.28.2",
                "@esbuild/openbsd-arm64": "0.28.2",
                "@esbuild/openbsd-x64": "0.28.2",
                "@esbuild/openharmony-arm64": "0.28.2",
                "@esbuild/sunos-x64": "0.28.2",
                "@esbuild/win32-arm64": "0.28.2",
                "@esbuild/win32-ia32": "0.28.2",
                "@esbuild/win32-x64": "0.28.2"
            }
        },
        "node_modules/escalade": {
            "version": "3.2.0",
            "resolved": "https://registry.npmjs.org/escalade/-/escalade-3.2.0.tgz",
            "integrity": "sha512-WUj2qlxaQtO4g6Pq5c29GTcWGDyd8itL8zTlipgECz3JesAiiOKotd8JU6otB3PACgG6xkJUyVhboMS+bje/jA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=6"
            }
        },
        "node_modules/fdir": {
            "version": "6.5.0",
            "resolved": "https://registry.npmjs.org/fdir/-/fdir-6.5.0.tgz",
            "integrity": "sha512-tIbYtZbucOs0BRGqPJkshJUYdL+SDH7dVM8gjy+ERp3WAUjLEFJE+02kanyHtwjWOnwrKYBiwAmM0p4kLJAnXg==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=12.0.0"
            },
            "peerDependencies": {
                "picomatch": "^3 || ^4"
            },
            "peerDependenciesMeta": {
                "picomatch": {
                    "optional": true
                }
            }
        },
        "node_modules/follow-redirects": {
            "version": "1.16.0",
            "resolved": "https://registry.npmjs.org/follow-redirects/-/follow-redirects-1.16.0.tgz",
            "integrity": "sha512-y5rN/uOsadFT/JfYwhxRS5R7Qce+g3zG97+JrtFZlC9klX/W5hD7iiLzScI4nZqUS7DNUdhPgw4xI8W2LuXlUw==",
            "dev": true,
            "funding": [
                {
                    "type": "individual",
                    "url": "https://github.com/sponsors/RubenVerborgh"
                }
            ],
            "license": "MIT",
            "engines": {
                "node": ">=4.0"
            },
            "peerDependenciesMeta": {
                "debug": {
                    "optional": true
                }
            }
        },
        "node_modules/form-data": {
            "version": "4.0.6",
            "resolved": "https://registry.npmjs.org/form-data/-/form-data-4.0.6.tgz",
            "integrity": "sha512-vKatAh4SlVfgbv+YtmhiRjhEMJsYpsG1Y2rMQtR+SVSbytsSD1YGzDIcrAJmdFec88u/+VoGmxnl+80gL1tRCQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "asynckit": "^0.4.0",
                "combined-stream": "^1.0.8",
                "es-set-tostringtag": "^2.1.0",
                "hasown": "^2.0.4",
                "mime-types": "^2.1.35"
            },
            "engines": {
                "node": ">= 6"
            }
        },
        "node_modules/fsevents": {
            "version": "2.3.3",
            "resolved": "https://registry.npmjs.org/fsevents/-/fsevents-2.3.3.tgz",
            "integrity": "sha512-5xoDfX+fL7faATnagmWPpbFtwh/R77WmMMqqHGS65C3vvB0YHrgF+B1YmZ3441tMj5n63k0212XNoJwzlhffQw==",
            "dev": true,
            "hasInstallScript": true,
            "license": "MIT",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": "^8.16.0 || ^10.6.0 || >=11.0.0"
            }
        },
        "node_modules/function-bind": {
            "version": "1.1.2",
            "resolved": "https://registry.npmjs.org/function-bind/-/function-bind-1.1.2.tgz",
            "integrity": "sha512-7XHNxH7qX9xG5mIwxkhumTox/MIRNcOgDrxWsMt2pAr23WHp6MrRlN7FBSFpCpr+oVO0F744iUgR82nJMfG2SA==",
            "dev": true,
            "license": "MIT",
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/get-caller-file": {
            "version": "2.0.5",
            "resolved": "https://registry.npmjs.org/get-caller-file/-/get-caller-file-2.0.5.tgz",
            "integrity": "sha512-DyFP3BM/3YHTQOCUL/w0OZHR0lpKeGrxotcHWcqNEdnltqFwXVfhEBQ94eIo34AfQpo0rGki4cyIiftY06h2Fg==",
            "dev": true,
            "license": "ISC",
            "engines": {
                "node": "6.* || 8.* || >= 10.*"
            }
        },
        "node_modules/get-intrinsic": {
            "version": "1.3.0",
            "resolved": "https://registry.npmjs.org/get-intrinsic/-/get-intrinsic-1.3.0.tgz",
            "integrity": "sha512-9fSjSaos/fRIVIp+xSJlE6lfwhES7LNtKaCBIamHsjr2na1BiABJPo0mOjjz8GJDURarmCPGqaiVg5mfjb98CQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "call-bind-apply-helpers": "^1.0.2",
                "es-define-property": "^1.0.1",
                "es-errors": "^1.3.0",
                "es-object-atoms": "^1.1.1",
                "function-bind": "^1.1.2",
                "get-proto": "^1.0.1",
                "gopd": "^1.2.0",
                "has-symbols": "^1.1.0",
                "hasown": "^2.0.2",
                "math-intrinsics": "^1.1.0"
            },
            "engines": {
                "node": ">= 0.4"
            },
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/get-proto": {
            "version": "1.0.1",
            "resolved": "https://registry.npmjs.org/get-proto/-/get-proto-1.0.1.tgz",
            "integrity": "sha512-sTSfBjoXBp89JvIKIefqw7U2CCebsc74kiY6awiGogKtoSGbgjYE/G/+l9sF3MWFPNc9IcoOC4ODfKHfxFmp0g==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "dunder-proto": "^1.0.1",
                "es-object-atoms": "^1.0.0"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/gopd": {
            "version": "1.2.0",
            "resolved": "https://registry.npmjs.org/gopd/-/gopd-1.2.0.tgz",
            "integrity": "sha512-ZUKRh6/kUFoAiTAtTYPZJ3hw9wNxx+BIBOijnlG9PnrJsCcSjs1wyyD6vJpaYtgnzDrKYRSqf3OO6Rfa93xsRg==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            },
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/graceful-fs": {
            "version": "4.2.11",
            "resolved": "https://registry.npmjs.org/graceful-fs/-/graceful-fs-4.2.11.tgz",
            "integrity": "sha512-RbJ5/jmFcNNCcDV5o9eTnBLJ/HszWV0P73bc+Ff4nS/rJj+YaS6IGyiOL0VoBYX+l1Wrl3k63h/KrH+nhJ0XvQ==",
            "dev": true,
            "license": "ISC"
        },
        "node_modules/has-flag": {
            "version": "4.0.0",
            "resolved": "https://registry.npmjs.org/has-flag/-/has-flag-4.0.0.tgz",
            "integrity": "sha512-EykJT/Q1KjTWctppgIAgfSO0tKVuZUjhgMr17kqTumMl6Afv3EISleU7qZUzoXDFTAHTDC4NOoG/ZxU3EvlMPQ==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/has-symbols": {
            "version": "1.1.0",
            "resolved": "https://registry.npmjs.org/has-symbols/-/has-symbols-1.1.0.tgz",
            "integrity": "sha512-1cDNdwJ2Jaohmb3sg4OmKaMBwuC48sYni5HUw2DvsC8LjGTLK9h+eb1X6RyuOHe4hT0ULCW68iomhjUoKUqlPQ==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            },
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/has-tostringtag": {
            "version": "1.0.2",
            "resolved": "https://registry.npmjs.org/has-tostringtag/-/has-tostringtag-1.0.2.tgz",
            "integrity": "sha512-NqADB8VjPFLM2V0VvHUewwwsw0ZWBaIdgo+ieHtK3hasLz4qeCRjYcqfB6AQrBggRKppKF8L52/VqdVsO47Dlw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "has-symbols": "^1.0.3"
            },
            "engines": {
                "node": ">= 0.4"
            },
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/hasown": {
            "version": "2.0.4",
            "resolved": "https://registry.npmjs.org/hasown/-/hasown-2.0.4.tgz",
            "integrity": "sha512-T2UbfbBEF32wiepXIsMlTW9+dDYC6wMh/t/vYA4tuOMKqWz/n3vr1NFSxQiyP+zk2mXsoMA/i/7qV6LKut1t1A==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "function-bind": "^1.1.2"
            },
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/https-proxy-agent": {
            "version": "5.0.1",
            "resolved": "https://registry.npmjs.org/https-proxy-agent/-/https-proxy-agent-5.0.1.tgz",
            "integrity": "sha512-dFcAjpTQFgoLMzC2VwU+C/CbS7uRL0lWmxDITmqm7C+7F0Odmj6s9l6alZc6AELXhrnggM2CeWSXHGOdX2YtwA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "agent-base": "6",
                "debug": "4"
            },
            "engines": {
                "node": ">= 6"
            }
        },
        "node_modules/is-fullwidth-code-point": {
            "version": "3.0.0",
            "resolved": "https://registry.npmjs.org/is-fullwidth-code-point/-/is-fullwidth-code-point-3.0.0.tgz",
            "integrity": "sha512-zymm5+u+sCsSWyD9qNaejV3DFvhCKclKdizYaJUuHA83RLjb7nSuGnddCHGv0hk+KY7BMAlsWeK4Ueg6EV6XQg==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/jiti": {
            "version": "2.7.0",
            "resolved": "https://registry.npmjs.org/jiti/-/jiti-2.7.0.tgz",
            "integrity": "sha512-AC/7JofJvZGrrneWNaEnJeOLUx+JlGt7tNa0wZiRPT4MY1wmfKjt2+6O2p2uz2+skll8OZZmJMNqeke7kKbNgQ==",
            "dev": true,
            "license": "MIT",
            "bin": {
                "jiti": "lib/jiti-cli.mjs"
            }
        },
        "node_modules/laravel-vite-plugin": {
            "version": "2.1.0",
            "resolved": "https://registry.npmjs.org/laravel-vite-plugin/-/laravel-vite-plugin-2.1.0.tgz",
            "integrity": "sha512-z+ck2BSV6KWtYcoIzk9Y5+p4NEjqM+Y4i8/H+VZRLq0OgNjW2DqyADquwYu5j8qRvaXwzNmfCWl1KrMlV1zpsg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "picocolors": "^1.0.0",
                "vite-plugin-full-reload": "^1.1.0"
            },
            "bin": {
                "clean-orphaned-assets": "bin/clean.js"
            },
            "engines": {
                "node": "^20.19.0 || >=22.12.0"
            },
            "peerDependencies": {
                "vite": "^7.0.0"
            }
        },
        "node_modules/lightningcss": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss/-/lightningcss-1.32.0.tgz",
            "integrity": "sha512-NXYBzinNrblfraPGyrbPoD19C1h9lfI/1mzgWYvXUTe414Gz/X1FD2XBZSZM7rRTrMA8JL3OtAaGifrIKhQ5yQ==",
            "dev": true,
            "license": "MPL-2.0",
            "dependencies": {
                "detect-libc": "^2.0.3"
            },
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            },
            "optionalDependencies": {
                "lightningcss-android-arm64": "1.32.0",
                "lightningcss-darwin-arm64": "1.32.0",
                "lightningcss-darwin-x64": "1.32.0",
                "lightningcss-freebsd-x64": "1.32.0",
                "lightningcss-linux-arm-gnueabihf": "1.32.0",
                "lightningcss-linux-arm64-gnu": "1.32.0",
                "lightningcss-linux-arm64-musl": "1.32.0",
                "lightningcss-linux-x64-gnu": "1.32.0",
                "lightningcss-linux-x64-musl": "1.32.0",
                "lightningcss-win32-arm64-msvc": "1.32.0",
                "lightningcss-win32-x64-msvc": "1.32.0"
            }
        },
        "node_modules/lightningcss-android-arm64": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-android-arm64/-/lightningcss-android-arm64-1.32.0.tgz",
            "integrity": "sha512-YK7/ClTt4kAK0vo6w3X+Pnm0D2cf2vPHbhOXdoNti1Ga0al1P4TBZhwjATvjNwLEBCnKvjJc2jQgHXH0NEwlAg==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "android"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-darwin-arm64": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-darwin-arm64/-/lightningcss-darwin-arm64-1.32.0.tgz",
            "integrity": "sha512-RzeG9Ju5bag2Bv1/lwlVJvBE3q6TtXskdZLLCyfg5pt+HLz9BqlICO7LZM7VHNTTn/5PRhHFBSjk5lc4cmscPQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-darwin-x64": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-darwin-x64/-/lightningcss-darwin-x64-1.32.0.tgz",
            "integrity": "sha512-U+QsBp2m/s2wqpUYT/6wnlagdZbtZdndSmut/NJqlCcMLTWp5muCrID+K5UJ6jqD2BFshejCYXniPDbNh73V8w==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "darwin"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-freebsd-x64": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-freebsd-x64/-/lightningcss-freebsd-x64-1.32.0.tgz",
            "integrity": "sha512-JCTigedEksZk3tHTTthnMdVfGf61Fky8Ji2E4YjUTEQX14xiy/lTzXnu1vwiZe3bYe0q+SpsSH/CTeDXK6WHig==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "freebsd"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-linux-arm-gnueabihf": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-linux-arm-gnueabihf/-/lightningcss-linux-arm-gnueabihf-1.32.0.tgz",
            "integrity": "sha512-x6rnnpRa2GL0zQOkt6rts3YDPzduLpWvwAF6EMhXFVZXD4tPrBkEFqzGowzCsIWsPjqSK+tyNEODUBXeeVHSkw==",
            "cpu": [
                "arm"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-linux-arm64-gnu": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-linux-arm64-gnu/-/lightningcss-linux-arm64-gnu-1.32.0.tgz",
            "integrity": "sha512-0nnMyoyOLRJXfbMOilaSRcLH3Jw5z9HDNGfT/gwCPgaDjnx0i8w7vBzFLFR1f6CMLKF8gVbebmkUN3fa/kQJpQ==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-linux-arm64-musl": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-linux-arm64-musl/-/lightningcss-linux-arm64-musl-1.32.0.tgz",
            "integrity": "sha512-UpQkoenr4UJEzgVIYpI80lDFvRmPVg6oqboNHfoH4CQIfNA+HOrZ7Mo7KZP02dC6LjghPQJeBsvXhJod/wnIBg==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-linux-x64-gnu": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-linux-x64-gnu/-/lightningcss-linux-x64-gnu-1.32.0.tgz",
            "integrity": "sha512-V7Qr52IhZmdKPVr+Vtw8o+WLsQJYCTd8loIfpDaMRWGUZfBOYEJeyJIkqGIDMZPwPx24pUMfwSxxI8phr/MbOA==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "glibc"
            ],
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-linux-x64-musl": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-linux-x64-musl/-/lightningcss-linux-x64-musl-1.32.0.tgz",
            "integrity": "sha512-bYcLp+Vb0awsiXg/80uCRezCYHNg1/l3mt0gzHnWV9XP1W5sKa5/TCdGWaR/zBM2PeF/HbsQv/j2URNOiVuxWg==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "libc": [
                "musl"
            ],
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "linux"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-win32-arm64-msvc": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-win32-arm64-msvc/-/lightningcss-win32-arm64-msvc-1.32.0.tgz",
            "integrity": "sha512-8SbC8BR40pS6baCM8sbtYDSwEVQd4JlFTOlaD3gWGHfThTcABnNDBda6eTZeqbofalIJhFx0qKzgHJmcPTnGdw==",
            "cpu": [
                "arm64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/lightningcss-win32-x64-msvc": {
            "version": "1.32.0",
            "resolved": "https://registry.npmjs.org/lightningcss-win32-x64-msvc/-/lightningcss-win32-x64-msvc-1.32.0.tgz",
            "integrity": "sha512-Amq9B/SoZYdDi1kFrojnoqPLxYhQ4Wo5XiL8EVJrVsB8ARoC1PWW6VGtT0WKCemjy8aC+louJnjS7U18x3b06Q==",
            "cpu": [
                "x64"
            ],
            "dev": true,
            "license": "MPL-2.0",
            "optional": true,
            "os": [
                "win32"
            ],
            "engines": {
                "node": ">= 12.0.0"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/parcel"
            }
        },
        "node_modules/magic-string": {
            "version": "0.30.21",
            "resolved": "https://registry.npmjs.org/magic-string/-/magic-string-0.30.21.tgz",
            "integrity": "sha512-vd2F4YUyEXKGcLHoq+TEyCjxueSeHnFxyyjNp80yg0XV4vUhnDer/lvvlqM/arB5bXQN5K2/3oinyCRyx8T2CQ==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@jridgewell/sourcemap-codec": "^1.5.5"
            }
        },
        "node_modules/math-intrinsics": {
            "version": "1.1.0",
            "resolved": "https://registry.npmjs.org/math-intrinsics/-/math-intrinsics-1.1.0.tgz",
            "integrity": "sha512-/IXtbwEk5HTPyEwyKX6hGkYXxM9nbj64B+ilVJnC/R6B0pH5G4V3b0pVbL7DBj4tkhBAppbQUlf6F6Xl9LHu1g==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            }
        },
        "node_modules/mime-db": {
            "version": "1.52.0",
            "resolved": "https://registry.npmjs.org/mime-db/-/mime-db-1.52.0.tgz",
            "integrity": "sha512-sPU4uV7dYlvtWJxwwxHD0PuihVNiE7TyAbQ5SWxDCB9mUYvOgroQOwYQQOKPJ8CIbE+1ETVlOoK1UC2nU3gYvg==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.6"
            }
        },
        "node_modules/mime-types": {
            "version": "2.1.35",
            "resolved": "https://registry.npmjs.org/mime-types/-/mime-types-2.1.35.tgz",
            "integrity": "sha512-ZDY+bPm5zTTF+YpCrAU9nK0UgICYPT0QtT1NZWFv4s++TNkcgVaT0g6+4R2uI4MjQjzysHB1zxuWL50hzaeXiw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "mime-db": "1.52.0"
            },
            "engines": {
                "node": ">= 0.6"
            }
        },
        "node_modules/ms": {
            "version": "2.1.3",
            "resolved": "https://registry.npmjs.org/ms/-/ms-2.1.3.tgz",
            "integrity": "sha512-6FlzubTLZG3J2a/NVCAleEhjzq5oxgHyaCU9yYXvcLsvoVaHJq/s5xXI6/XXP6tz7R9xAOtHnSO/tXtF3WRTlA==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/nanoid": {
            "version": "3.3.19",
            "resolved": "https://registry.npmjs.org/nanoid/-/nanoid-3.3.19.tgz",
            "integrity": "sha512-Y2tUNy4ouw6tq5oDSKeQYGOyhkUBhNOcGV/02KC+6kd9eDGqdZd++mjMiIDilrBYvjEnCYvVtsuHCuP+okSfug==",
            "dev": true,
            "funding": [
                {
                    "type": "github",
                    "url": "https://github.com/sponsors/ai"
                }
            ],
            "license": "MIT",
            "bin": {
                "nanoid": "bin/nanoid.cjs"
            },
            "engines": {
                "node": "^10 || ^12 || ^13.7 || ^14 || >=15.0.1"
            }
        },
        "node_modules/picocolors": {
            "version": "1.1.1",
            "resolved": "https://registry.npmjs.org/picocolors/-/picocolors-1.1.1.tgz",
            "integrity": "sha512-xceH2snhtb5M9liqDsmEw56le376mTZkEX/jEb/RxNFyegNul7eNslCXP9FDj/Lcu0X8KEyMceP2ntpaHrDEVA==",
            "dev": true,
            "license": "ISC"
        },
        "node_modules/picomatch": {
            "version": "4.0.7",
            "resolved": "https://registry.npmjs.org/picomatch/-/picomatch-4.0.7.tgz",
            "integrity": "sha512-qcJu88Q2IWqJsDD529JKMdwGm/dvInW4HvQnRwiH9JtihJvzGOscDtHE3x1pBKeUOTysQ8kVmLnJ2kJu7yhcGA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=12"
            },
            "funding": {
                "url": "https://github.com/sponsors/jonschlinkert"
            }
        },
        "node_modules/postcss": {
            "version": "8.5.28",
            "resolved": "https://registry.npmjs.org/postcss/-/postcss-8.5.28.tgz",
            "integrity": "sha512-RRuzqDtt5Y9h3quz5hWhK+TPnsmVs6WwSU6LkJMeY4HstUEDuYTG8UJSdawMRzmzAtV+KEoG8N3Qg2qLy5vM/A==",
            "dev": true,
            "funding": [
                {
                    "type": "opencollective",
                    "url": "https://opencollective.com/postcss/"
                },
                {
                    "type": "tidelift",
                    "url": "https://tidelift.com/funding/github/npm/postcss"
                },
                {
                    "type": "github",
                    "url": "https://github.com/sponsors/ai"
                }
            ],
            "license": "MIT",
            "dependencies": {
                "nanoid": "^3.3.18",
                "picocolors": "^1.1.1",
                "source-map-js": "^1.2.1"
            },
            "engines": {
                "node": "^10 || ^12 || >=14"
            }
        },
        "node_modules/proxy-from-env": {
            "version": "2.1.0",
            "resolved": "https://registry.npmjs.org/proxy-from-env/-/proxy-from-env-2.1.0.tgz",
            "integrity": "sha512-cJ+oHTW1VAEa8cJslgmUZrc+sjRKgAKl3Zyse6+PV38hZe/V6Z14TbCuXcan9F9ghlz4QrFr2c92TNF82UkYHA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=10"
            }
        },
        "node_modules/require-directory": {
            "version": "2.1.1",
            "resolved": "https://registry.npmjs.org/require-directory/-/require-directory-2.1.1.tgz",
            "integrity": "sha512-fGxEI7+wsG9xrvdjsrlmL22OMTTiHRwAMroiEeMgq8gzoLC/PQr7RsRDSTLUg/bZAZtF+TVIkHc6/4RIKrui+Q==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=0.10.0"
            }
        },
        "node_modules/rollup": {
            "version": "4.63.3",
            "resolved": "https://registry.npmjs.org/rollup/-/rollup-4.63.3.tgz",
            "integrity": "sha512-1i2XreiAoMMXuPGD6Msj2xWrMMkHojNRKivInxGQcg7/1KuPuYlfUutLyh4drnOxUTHX9cHI4wFoat8D/NKaBw==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "@types/estree": "1.0.9"
            },
            "bin": {
                "rollup": "dist/bin/rollup"
            },
            "engines": {
                "node": ">=18.0.0",
                "npm": ">=8.0.0"
            },
            "optionalDependencies": {
                "@napi-rs/lzma-linux-x64-gnu": "1.5.1",
                "@rollup/rollup-android-arm-eabi": "4.63.3",
                "@rollup/rollup-android-arm64": "4.63.3",
                "@rollup/rollup-darwin-arm64": "4.63.3",
                "@rollup/rollup-darwin-x64": "4.63.3",
                "@rollup/rollup-freebsd-arm64": "4.63.3",
                "@rollup/rollup-freebsd-x64": "4.63.3",
                "@rollup/rollup-linux-arm-gnueabihf": "4.63.3",
                "@rollup/rollup-linux-arm-musleabihf": "4.63.3",
                "@rollup/rollup-linux-arm64-gnu": "4.63.3",
                "@rollup/rollup-linux-arm64-musl": "4.63.3",
                "@rollup/rollup-linux-loong64-gnu": "4.63.3",
                "@rollup/rollup-linux-loong64-musl": "4.63.3",
                "@rollup/rollup-linux-ppc64-gnu": "4.63.3",
                "@rollup/rollup-linux-ppc64-musl": "4.63.3",
                "@rollup/rollup-linux-riscv64-gnu": "4.63.3",
                "@rollup/rollup-linux-riscv64-musl": "4.63.3",
                "@rollup/rollup-linux-s390x-gnu": "4.63.3",
                "@rollup/rollup-linux-x64-gnu": "4.63.3",
                "@rollup/rollup-linux-x64-musl": "4.63.3",
                "@rollup/rollup-openbsd-x64": "4.63.3",
                "@rollup/rollup-openharmony-arm64": "4.63.3",
                "@rollup/rollup-win32-arm64-msvc": "4.63.3",
                "@rollup/rollup-win32-ia32-msvc": "4.63.3",
                "@rollup/rollup-win32-x64-gnu": "4.63.3",
                "@rollup/rollup-win32-x64-msvc": "4.63.3",
                "fsevents": "~2.3.2"
            }
        },
        "node_modules/rxjs": {
            "version": "7.8.2",
            "resolved": "https://registry.npmjs.org/rxjs/-/rxjs-7.8.2.tgz",
            "integrity": "sha512-dhKf903U/PQZY6boNNtAGdWbG85WAbjT/1xYoZIC7FAY0yWapOBQVsVrDl58W86//e1VpMNBtRV4MaXfdMySFA==",
            "dev": true,
            "license": "Apache-2.0",
            "dependencies": {
                "tslib": "^2.1.0"
            }
        },
        "node_modules/shell-quote": {
            "version": "1.9.0",
            "resolved": "https://registry.npmjs.org/shell-quote/-/shell-quote-1.9.0.tgz",
            "integrity": "sha512-Iov+JwFv/2HcTpcwNMKd8+IWNb8tboQJNQTkAY/LLVK7gGH9jy+LGkVqPxfekHl+yMmiqXszdGWXgkfml7hjqA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">= 0.4"
            },
            "funding": {
                "url": "https://github.com/sponsors/ljharb"
            }
        },
        "node_modules/source-map-js": {
            "version": "1.2.1",
            "resolved": "https://registry.npmjs.org/source-map-js/-/source-map-js-1.2.1.tgz",
            "integrity": "sha512-UXWMKhLOwVKb728IUtQPXxfYU+usdybtUrK/8uGE8CQMvrhOpwvzDBwj0QhSL7MQc7vIsISBG8VQ8+IDQxpfQA==",
            "dev": true,
            "license": "BSD-3-Clause",
            "engines": {
                "node": ">=0.10.0"
            }
        },
        "node_modules/string-width": {
            "version": "4.2.3",
            "resolved": "https://registry.npmjs.org/string-width/-/string-width-4.2.3.tgz",
            "integrity": "sha512-wKyQRQpjJ0sIp62ErSZdGsjMJWsap5oRNihHhu6G7JVO/9jIB6UyevL+tXuOqrng8j/cxKTWyWUwvSTriiZz/g==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "emoji-regex": "^8.0.0",
                "is-fullwidth-code-point": "^3.0.0",
                "strip-ansi": "^6.0.1"
            },
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/strip-ansi": {
            "version": "6.0.1",
            "resolved": "https://registry.npmjs.org/strip-ansi/-/strip-ansi-6.0.1.tgz",
            "integrity": "sha512-Y38VPSHcqkFrCpFnQ9vuSXmquuv5oXOKpGeT6aGrr3o3Gc9AlVa6JBfUSOCnbxGGZF+/0ooI7KrPuUSztUdU5A==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "ansi-regex": "^5.0.1"
            },
            "engines": {
                "node": ">=8"
            }
        },
        "node_modules/supports-color": {
            "version": "8.1.1",
            "resolved": "https://registry.npmjs.org/supports-color/-/supports-color-8.1.1.tgz",
            "integrity": "sha512-MpUEN2OodtUzxvKQl72cUF7RQ5EiHsGvSsVG0ia9c5RbWGL2CI4C7EpPS8UTBIplnlzZiNuV56w+FuNxy3ty2Q==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "has-flag": "^4.0.0"
            },
            "engines": {
                "node": ">=10"
            },
            "funding": {
                "url": "https://github.com/chalk/supports-color?sponsor=1"
            }
        },
        "node_modules/tailwindcss": {
            "version": "4.3.3",
            "resolved": "https://registry.npmjs.org/tailwindcss/-/tailwindcss-4.3.3.tgz",
            "integrity": "sha512-gOhV3P7ufE62QDGg1zVaTgCR+EtPv92k2nIhVcVKcLmxT1sUBsQGhnZj175j+MqRt4zLF7ic+sCYjfhxMxj7YQ==",
            "dev": true,
            "license": "MIT"
        },
        "node_modules/tapable": {
            "version": "2.3.3",
            "resolved": "https://registry.npmjs.org/tapable/-/tapable-2.3.3.tgz",
            "integrity": "sha512-uxc/zpqFg6x7C8vOE7lh6Lbda8eEL9zmVm/PLeTPBRhh1xCgdWaQ+J1CUieGpIfm2HdtsUpRv+HshiasBMcc6A==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=6"
            },
            "funding": {
                "type": "opencollective",
                "url": "https://opencollective.com/webpack"
            }
        },
        "node_modules/tinyglobby": {
            "version": "0.2.17",
            "resolved": "https://registry.npmjs.org/tinyglobby/-/tinyglobby-0.2.17.tgz",
            "integrity": "sha512-wXR/dYpcqKmfWpEdZjiKJOwCNFndD0DMnrW/cYjVGttEkBfVgcLFHoNrlj47mjOVic9yyNu65alsgF4NQyTa2g==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "fdir": "^6.5.0",
                "picomatch": "^4.0.4"
            },
            "engines": {
                "node": ">=12.0.0"
            },
            "funding": {
                "url": "https://github.com/sponsors/SuperchupuDev"
            }
        },
        "node_modules/tree-kill": {
            "version": "1.2.2",
            "resolved": "https://registry.npmjs.org/tree-kill/-/tree-kill-1.2.2.tgz",
            "integrity": "sha512-L0Orpi8qGpRG//Nd+H90vFB+3iHnue1zSSGmNOOCh1GLJ7rUKVwV2HvijphGQS2UmhUZewS9VgvxYIdgr+fG1A==",
            "dev": true,
            "license": "MIT",
            "bin": {
                "tree-kill": "cli.js"
            }
        },
        "node_modules/tslib": {
            "version": "2.8.1",
            "resolved": "https://registry.npmjs.org/tslib/-/tslib-2.8.1.tgz",
            "integrity": "sha512-oJFu94HQb+KVduSUQL7wnpmqnfmLsOA/nAh6b6EH0wCEoK0/mPeXU6c3wKDV83MkOuHPRHtSXKKU99IBazS/2w==",
            "dev": true,
            "license": "0BSD"
        },
        "node_modules/vite": {
            "version": "7.3.6",
            "resolved": "https://registry.npmjs.org/vite/-/vite-7.3.6.tgz",
            "integrity": "sha512-4XP60spRGjSZFf1qYH+dJIkK2znL3zQfl9KkOV9MkkRR/3Dls0dxaBsQPTloEc5BLXWPL9vsOxopxyKoMmDueg==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "esbuild": "^0.27.0 || ^0.28.0",
                "fdir": "^6.5.0",
                "picomatch": "^4.0.3",
                "postcss": "^8.5.6",
                "rollup": "^4.43.0",
                "tinyglobby": "^0.2.15"
            },
            "bin": {
                "vite": "bin/vite.js"
            },
            "engines": {
                "node": "^20.19.0 || >=22.12.0"
            },
            "funding": {
                "url": "https://github.com/vitejs/vite?sponsor=1"
            },
            "optionalDependencies": {
                "fsevents": "~2.3.3"
            },
            "peerDependencies": {
                "@types/node": "^20.19.0 || >=22.12.0",
                "jiti": ">=1.21.0",
                "less": "^4.0.0",
                "lightningcss": "^1.21.0",
                "sass": "^1.70.0",
                "sass-embedded": "^1.70.0",
                "stylus": ">=0.54.8",
                "sugarss": "^5.0.0",
                "terser": "^5.16.0",
                "tsx": "^4.8.1",
                "yaml": "^2.4.2"
            },
            "peerDependenciesMeta": {
                "@types/node": {
                    "optional": true
                },
                "jiti": {
                    "optional": true
                },
                "less": {
                    "optional": true
                },
                "lightningcss": {
                    "optional": true
                },
                "sass": {
                    "optional": true
                },
                "sass-embedded": {
                    "optional": true
                },
                "stylus": {
                    "optional": true
                },
                "sugarss": {
                    "optional": true
                },
                "terser": {
                    "optional": true
                },
                "tsx": {
                    "optional": true
                },
                "yaml": {
                    "optional": true
                }
            }
        },
        "node_modules/vite-plugin-full-reload": {
            "version": "1.2.0",
            "resolved": "https://registry.npmjs.org/vite-plugin-full-reload/-/vite-plugin-full-reload-1.2.0.tgz",
            "integrity": "sha512-kz18NW79x0IHbxRSHm0jttP4zoO9P9gXh+n6UTwlNKnviTTEpOlum6oS9SmecrTtSr+muHEn5TUuC75UovQzcA==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "picocolors": "^1.0.0",
                "picomatch": "^2.3.1"
            }
        },
        "node_modules/vite-plugin-full-reload/node_modules/picomatch": {
            "version": "2.3.2",
            "resolved": "https://registry.npmjs.org/picomatch/-/picomatch-2.3.2.tgz",
            "integrity": "sha512-V7+vQEJ06Z+c5tSye8S+nHUfI51xoXIXjHQ99cQtKUkQqqO1kO/KCJUfZXuB47h/YBlDhah2H3hdUGXn8ie0oA==",
            "dev": true,
            "license": "MIT",
            "engines": {
                "node": ">=8.6"
            },
            "funding": {
                "url": "https://github.com/sponsors/jonschlinkert"
            }
        },
        "node_modules/wrap-ansi": {
            "version": "7.0.0",
            "resolved": "https://registry.npmjs.org/wrap-ansi/-/wrap-ansi-7.0.0.tgz",
            "integrity": "sha512-YVGIj2kamLSTxw6NsZjoBxfSwsn0ycdesmc4p+Q21c5zPuZ1pl+NfxVdxPtdHvmNVOQ6XSYG4AUtyt/Fi7D16Q==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "ansi-styles": "^4.0.0",
                "string-width": "^4.1.0",
                "strip-ansi": "^6.0.0"
            },
            "engines": {
                "node": ">=10"
            },
            "funding": {
                "url": "https://github.com/chalk/wrap-ansi?sponsor=1"
            }
        },
        "node_modules/y18n": {
            "version": "5.0.8",
            "resolved": "https://registry.npmjs.org/y18n/-/y18n-5.0.8.tgz",
            "integrity": "sha512-0pfFzegeDWJHJIAmTLRP2DwHjdF5s7jo9tuztdQxAhINCdvS+3nGINqPd00AphqJR/0LhANUS6/+7SCb98YOfA==",
            "dev": true,
            "license": "ISC",
            "engines": {
                "node": ">=10"
            }
        },
        "node_modules/yargs": {
            "version": "17.7.2",
            "resolved": "https://registry.npmjs.org/yargs/-/yargs-17.7.2.tgz",
            "integrity": "sha512-7dSzzRQ++CKnNI/krKnYRV7JKKPUXMEh61soaHKg9mrWEhzFWhFnxPxGl+69cD1Ou63C13NUPCnmIcrvqCuM6w==",
            "dev": true,
            "license": "MIT",
            "dependencies": {
                "cliui": "^8.0.1",
                "escalade": "^3.1.1",
                "get-caller-file": "^2.0.5",
                "require-directory": "^2.1.1",
                "string-width": "^4.2.3",
                "y18n": "^5.0.5",
                "yargs-parser": "^21.1.1"
            },
            "engines": {
                "node": ">=12"
            }
        },
        "node_modules/yargs-parser": {
            "version": "21.1.1",
            "resolved": "https://registry.npmjs.org/yargs-parser/-/yargs-parser-21.1.1.tgz",
            "integrity": "sha512-tVpsJW7DdjecAiFpbIB1e3qxIQsE6NoPc5/eTdrbbIC4h0LVsWhnoa3g+m2HclBIujHzsxZ4VJVA+GUuc2/LBw==",
            "dev": true,
            "license": "ISC",
            "engines": {
                "node": ">=12"
            }
        }
    }
}
```

## package.json

```json
{
    "$schema": "https://www.schemastore.org/package.json",
    "private": true,
    "type": "module",
    "scripts": {
        "build": "vite build",
        "dev": "vite"
    },
    "devDependencies": {
        "@tailwindcss/vite": "^4.0.0",
        "axios": "^1.11.0",
        "concurrently": "^9.0.1",
        "laravel-vite-plugin": "^2.0.0",
        "tailwindcss": "^4.0.0",
        "vite": "^7.0.7"
    }
}
```

## phpunit.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="vendor/phpunit/phpunit/phpunit.xsd"
         bootstrap="vendor/autoload.php"
         colors="true"
>
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory>tests/Feature</directory>
        </testsuite>
    </testsuites>
    <source>
        <include>
            <directory>app</directory>
        </include>
    </source>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="APP_MAINTENANCE_DRIVER" value="file"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="BROADCAST_CONNECTION" value="null"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        <env name="DB_URL" value=""/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="PULSE_ENABLED" value="false"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
        <env name="NIGHTWATCH_ENABLED" value="false"/>
    </php>
</phpunit>
```

## public/index.php

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
```

## public/storage/.gitignore

```gitignore
*
!.gitignore
```

## resources/css/app.css

```css
@import "tailwindcss";

/* =========================================================
   THÈME SGFORMATEURS — VERT ÉMERAUDE
   Couleur principale : vert (aucun bleu)
========================================================= */

@theme {
    --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;

    /* Vert émeraude principal */
    --color-brand-50:  #ecfdf5;
    --color-brand-100: #d1fae5;
    --color-brand-200: #a7f3d0;
    --color-brand-300: #6ee7b7;
    --color-brand-400: #34d399;
    --color-brand-500: #10b981;
    --color-brand-600: #059669;
    --color-brand-700: #047857;
    --color-brand-800: #065f46;
    --color-brand-900: #064e3b;   /* sidebar */
    --color-brand-950: #022c22;

    /* Couleurs secondaires (remplacent l'ancien bleu) */
    --color-accent-50:  #f0fdfa;
    --color-accent-100: #ccfbf1;
    --color-accent-500: #14b8a6;
    --color-accent-600: #0d9488;
    --color-accent-700: #0f766e;
}

/* =========================================================
   BASE
========================================================= */

@layer base {
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }

    body {
        @apply font-sans bg-slate-50 text-slate-900 antialiased;
    }

    ::-webkit-scrollbar { @apply w-1.5 h-1.5; }
    ::-webkit-scrollbar-thumb { @apply bg-brand-500 rounded-full; }
    ::-webkit-scrollbar-track { @apply bg-slate-100; }

    .material-symbols-rounded {
        font-size: 20px;
        line-height: 1;
        vertical-align: middle;
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
}

/* =========================================================
   COMPOSANTS
   NB : Tailwind v4 n'autorise pas `@apply` sur une classe
   personnalisée. Les styles de base sont donc partagés
   via une liste de sélecteurs.
========================================================= */

@layer components {

    /* ---------- BOUTONS ---------- */
    .btn,
    .btn-primary,
    .btn-outline-primary,
    .btn-secondary,
    .btn-danger,
    .btn-ghost {
        @apply inline-flex items-center justify-center gap-2
               px-5 py-2.5 rounded-lg font-semibold text-sm
               transition-all duration-200 cursor-pointer
               focus:outline-none focus:ring-4;
    }
    .btn-primary {
        @apply bg-brand-600 text-white shadow-sm
               hover:bg-brand-700 hover:-translate-y-0.5
               hover:shadow-md focus:ring-brand-100;
    }
    .btn-outline-primary {
        @apply border border-brand-600 text-brand-700 bg-transparent
               hover:bg-brand-600 hover:text-white focus:ring-brand-100;
    }
    .btn-secondary {
        @apply bg-slate-100 text-slate-700
               hover:bg-slate-200 focus:ring-slate-100;
    }
    .btn-danger {
        @apply bg-red-600 text-white
               hover:bg-red-700 focus:ring-red-100;
    }
    .btn-ghost {
        @apply bg-transparent text-slate-500
               hover:bg-slate-100 hover:text-slate-800;
    }
    .btn-sm { @apply px-3.5 py-2 text-xs; }

    /* ---------- SIDEBAR ---------- */
    .sidebar-item,
    .sidebar-item-active,
    .sidebar-item-inactive {
        @apply flex items-center gap-3 px-3 py-2.5 rounded-lg
               text-sm font-medium transition-all duration-150;
    }
    .sidebar-item-active {
        @apply bg-white/10 text-white;
    }
    .sidebar-item-inactive {
        @apply text-emerald-100/70
               hover:bg-white/5 hover:text-white;
    }

    /* ---------- CARTES STATS ---------- */
    .stat-card {
        @apply bg-white rounded-xl border border-slate-200 p-5
               flex items-start gap-4 transition-all hover:shadow-md;
    }
    .stat-icon {
        @apply w-12 h-12 rounded-lg flex items-center justify-center shrink-0;
    }
    .stat-value {
        @apply font-display text-2xl font-bold text-slate-900 leading-none;
    }
    .stat-label {
        @apply text-xs text-slate-500 mt-1;
    }
    .stat-trend-up {
        @apply text-xs font-semibold text-emerald-600;
    }

    /* ---------- FORMULAIRES ---------- */
    .form-label {
        @apply block text-[13px] font-semibold text-slate-700 mb-1.5;
    }
    .form-input,
    .form-select,
    .form-textarea {
        @apply w-full px-3.5 py-2.5 rounded-lg
               border border-slate-200 bg-white
               text-sm text-slate-900 placeholder:text-slate-400
               focus:border-brand-500 focus:ring-2 focus:ring-brand-100
               focus:outline-none transition-all;
    }
    .form-error {
        @apply text-xs text-red-600 mt-1;
    }

    /* ---------- TABLEAU ---------- */
    .table-modern { @apply w-full text-sm; }
    .table-modern thead {
        @apply bg-slate-50 border-b border-slate-200;
    }
    .table-modern thead th {
        @apply px-4 py-3 text-left text-[11px] font-bold
               text-slate-500 uppercase tracking-wider;
    }
    .table-modern tbody tr {
        @apply border-b border-slate-100 hover:bg-brand-50/40 transition;
    }
    .table-modern tbody td {
        @apply px-4 py-3 text-slate-700;
    }

    /* ---------- BADGES ---------- */
    .badge,
    .badge-success,
    .badge-danger,
    .badge-warning,
    .badge-info,
    .badge-gray {
        @apply inline-flex items-center gap-1 px-2.5 py-0.5
               rounded-full text-[11px] font-semibold;
    }
    .badge-success { @apply bg-emerald-100 text-emerald-700; }
    .badge-danger  { @apply bg-red-100 text-red-700; }
    .badge-warning { @apply bg-amber-100 text-amber-700; }
    .badge-info    { @apply bg-teal-100 text-teal-700; }
    .badge-gray    { @apply bg-slate-100 text-slate-600; }

    /* ---------- CARTES ---------- */
    .card {
        @apply bg-white rounded-xl border border-slate-200;
    }
    .card-header {
        @apply px-5 py-4 border-b border-slate-100
               flex items-center justify-between;
    }
    .card-title {
        @apply font-display font-semibold text-slate-900;
    }
    .card-body { @apply p-5; }

    /* ---------- AVATAR ---------- */
    .avatar,
    .avatar-sm,
    .avatar-md,
    .avatar-lg {
        @apply rounded-full flex items-center justify-center
               font-bold text-white shrink-0;
    }
    .avatar-sm { @apply w-8 h-8 text-[10px]; }
    .avatar-md { @apply w-10 h-10 text-xs; }
    .avatar-lg { @apply w-16 h-16 text-lg; }
    .avatar-primary { @apply bg-gradient-to-br from-brand-500 to-brand-700; }

    /* ---------- LIENS / PAGINATION ---------- */
    .link-primary {
        @apply text-brand-700 font-medium hover:text-brand-800
               hover:underline transition;
    }
}

/* =========================================================
   SURCHARGE PAGINATION LARAVEL (retire tout reste de bleu)
========================================================= */

.pagination .active span,
[aria-current="page"] span {
    background-color: var(--color-brand-600) !important;
    border-color: var(--color-brand-600) !important;
    color: #fff !important;
}

/* =========================================================
   UTILITAIRES
========================================================= */

@layer utilities {
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes pulseSlow {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-6px); }
    }
    .animate-fade-up { animation: fadeUp 0.5s ease-out; }
    .animate-slide-in { animation: slideIn 0.3s ease-out; }
    .animate-pulse-slow { animation: pulseSlow 3s ease-in-out infinite; }
}
```

## resources/js/app.js

```js
import './bootstrap';
```

## resources/js/bootstrap.js

```js
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
```

## resources/views/admin/affectations/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouvelle affectation')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.affectations.index') }}"
           class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-brand-700 mb-3 transition">
            <span class="material-symbols-rounded text-lg">arrow_back</span>
            Retour à la liste
        </a>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700
                        flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">add_task</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Nouvelle affectation</h1>
                <p class="text-sm text-slate-500 mt-1">Créer une affectation pour un formateur</p>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('admin.affectations.store') }}"
          class="bg-white rounded-2xl border-2 border-slate-200 p-6 shadow-sm">
        @csrf

        @include('admin.affectations.partials.form')

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t-2 border-slate-100">
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-lg">close</span>
                Annuler
            </a>
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-lg">save</span>
                Enregistrer
            </button>
        </div>
    </form>

</div>

@endsection
```

## resources/views/admin/affectations/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier affectation')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <a href="{{ route('admin.affectations.index') }}"
           class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-brand-700 mb-3 transition">
            <span class="material-symbols-rounded text-lg">arrow_back</span>
            Retour à la liste
        </a>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700
                        flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">edit</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Modifier l'affectation</h1>
                <p class="text-sm text-slate-500 mt-1">Affectation #{{ $affectation->id }}</p>
            </div>
        </div>
    </div>

    {{-- Formulaire --}}
    <form method="POST" action="{{ route('admin.affectations.update', $affectation->id) }}"
          class="bg-white rounded-2xl border-2 border-slate-200 p-6 shadow-sm">
        @csrf
        @method('PUT')

        @include('admin.affectations.partials.form')

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t-2 border-slate-100">
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-lg">close</span>
                Annuler
            </a>
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-lg">save</span>
                Mettre à jour
            </button>
        </div>
    </form>

</div>

@endsection
```

## resources/views/admin/affectations/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Affectations')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Affectations</h1>
        <p class="text-sm text-slate-500 mt-1">Liste des affectations des formateurs</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.pdf.affectations') }}" target="_blank" class="btn-secondary">
            <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
            PDF
        </a>
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouvelle affectation
        </button>
    </div>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher un formateur..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md
                          focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="etablissement_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="filiere_id" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Toutes les filières</option>
            @foreach($filieres ?? [] as $f)
                <option value="{{ $f->id }}" @selected(request('filiere_id') == $f->id)>{{ $f->libelle }}</option>
            @endforeach
        </select>
        <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="termine" @selected(request('statut') === 'termine')>Terminé</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="md:col-span-5 flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.affectations.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($affectations ?? [] as $a)
            <tr>
                <td>
                    <a href="{{ route('admin.formateurs.show', $a->formateur->id ?? 0) }}" class="flex items-center gap-2 group">
                        <div class="avatar avatar-sm avatar-primary">
                            {{ strtoupper(substr($a->formateur->prenom ?? 'U', 0, 1) . substr($a->formateur->nom ?? 'N', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm group-hover:text-brand-700">{{ $a->formateur->nom ?? '—' }} {{ $a->formateur->prenom ?? '' }}</div>
                            <div class="text-[10px] text-slate-500 font-mono">{{ $a->formateur->matricule ?? '' }}</div>
                        </div>
                    </a>
                </td>
                <td class="font-semibold">{{ $a->filiere->libelle ?? '—' }}</td>
                <td>{{ $a->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} → {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'termine')
                        <span class="badge-gray">Terminé</span>
                    @else
                        <span class="badge-warning">Suspendu</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $a->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        <form action="{{ route('admin.affectations.destroy', $a->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                <span class="material-symbols-rounded text-lg">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucune affectation trouvée</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $affectations->total() ?? 0 }} affectations</span>
        <div>{{ $affectations->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">add_task</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouvelle affectation</h2>
                    <p class="text-xs text-slate-500">Créer une affectation pour un formateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.affectations.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier l'affectation</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeShowModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail de l'affectation</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<script>
    console.log('✅ Script affectations chargé');

    // ============= CREATE =============
    function openCreateModal() {
        console.log('🔵 Ouverture modal CREATE');
        const modal = document.getElementById('createModal');
        if (!modal) {
            console.error('❌ Modal CREATE introuvable');
            return;
        }
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch('{{ route("admin.affectations.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('📦 Formulaire CREATE chargé');
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeCreateModal() {
        console.log('🔴 Fermeture modal CREATE');
        const modal = document.getElementById('createModal');
        if (modal) {
            modal.style.display = 'none';
        }
        document.body.style.overflow = '';
    }

    // ============= EDIT =============
    function openEditModal(id) {
        console.log('🔵 Ouverture modal EDIT', id);
        const modal = document.getElementById('editModal');
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('editForm');
        form.action = `/admin/affectations/${id}`;

        fetch(`/admin/affectations/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('📦 Formulaire EDIT chargé');
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeEditModal() {
        console.log('🔴 Fermeture modal EDIT');
        const modal = document.getElementById('editModal');
        if (modal) {
            modal.style.display = 'none';
        }
        document.body.style.overflow = '';
    }

    // ============= SHOW =============
    function openShowModal(id) {
        console.log('🔵 Ouverture modal SHOW', id);
        const modal = document.getElementById('showModal');
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch(`/admin/affectations/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('❌', err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeShowModal() {
        console.log('🔴 Fermeture modal SHOW');
        const modal = document.getElementById('showModal');
        if (modal) {
            modal.style.display = 'none';
        }
        document.body.style.overflow = '';
    }

    // ============= SOUMISSION AJAX =============
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('📤 Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('✅ Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('❌', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ============= ESCAPE =============
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
            closeShowModal();
        }
    });

    // ============= RENDEZ LES FONCTIONS GLOBALES =============
    window.openCreateModal = openCreateModal;
    window.closeCreateModal = closeCreateModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.openShowModal = openShowModal;
    window.closeShowModal = closeShowModal;

    console.log('✅ Fonctions modal exposées globalement');
</script>

@endsection
```

## resources/views/admin/affectations/partials/form.blade.php

```blade
<div class="space-y-5">

    {{-- ========== SECTION : AFFECTATION ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">link</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Affectation</h3>
        </div>

        <div class="space-y-4">

            {{-- Formateur --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Formateur <span class="text-red-600">*</span>
                </label>
                <select name="formateur_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner un formateur —</option>
                    @foreach($formateurs ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('formateur_id', $affectation->formateur_id ?? '') == $f->id)>
                            {{ $f->nom }} {{ $f->prenom }} ({{ $f->matricule }})
                        </option>
                    @endforeach
                </select>
                @error('formateur_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Filière --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Filière <span class="text-red-600">*</span>
                </label>
                <select name="filiere_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner une filière —</option>
                    @foreach($filieres ?? [] as $f)
                        <option value="{{ $f->id }}" @selected(old('filiere_id', $affectation->filiere_id ?? '') == $f->id)>
                            {{ $f->libelle }} ({{ $f->code }})
                        </option>
                    @endforeach
                </select>
                @error('filiere_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Établissement --}}
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Établissement <span class="text-red-600">*</span>
                </label>
                <select name="etablissement_id"
                        class="w-full px-4 py-3 text-base text-slate-900 bg-white
                               border-2 border-slate-300 rounded-md
                               transition-all appearance-none cursor-pointer
                               hover:border-slate-400
                               focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                    <option value="">— Sélectionner un établissement —</option>
                    @foreach($etablissements ?? [] as $e)
                        <option value="{{ $e->id }}" @selected(old('etablissement_id', $affectation->etablissement_id ?? '') == $e->id)>
                            {{ $e->nom }} ({{ $e->code }})
                        </option>
                    @endforeach
                </select>
                @error('etablissement_id')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </div>

    {{-- ========== SECTION : PÉRIODE ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">event</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Période</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Date de début <span class="text-red-600">*</span>
                </label>
                <input type="date" name="date_debut"
                       value="{{ old('date_debut', isset($affectation) && $affectation->date_debut ? $affectation->date_debut->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('date_debut')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Date de fin</label>
                <input type="date" name="date_fin"
                       value="{{ old('date_fin', isset($affectation) && $affectation->date_fin ? $affectation->date_fin->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-3 text-base text-slate-900 bg-white
                              border-2 border-slate-300 rounded-md
                              transition-all cursor-pointer
                              hover:border-slate-400
                              focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
                @error('date_fin')
                    <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
                @enderror
                <p class="text-xs text-slate-500 mt-1.5">Laisser vide si en cours</p>
            </div>

        </div>
    </div>

    {{-- ========== SECTION : STATUT (SELECT) ========== --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">toggle_on</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Statut</h3>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                Statut de l'affectation <span class="text-red-600">*</span>
            </label>
            <select name="statut"
                    class="w-full px-4 py-3 text-base text-slate-900 bg-white
                           border-2 border-slate-300 rounded-md
                           transition-all appearance-none cursor-pointer
                           hover:border-slate-400
                           focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                    required>
                <option value="actif" @selected(old('statut', $affectation->statut ?? 'actif') === 'actif')>
                    Actif — Le formateur est en activité
                </option>
                <option value="suspendu" @selected(old('statut', $affectation->statut ?? '') === 'suspendu')>
                    Suspendu — Le formateur est en pause
                </option>
                <option value="termine" @selected(old('statut', $affectation->statut ?? '') === 'termine')>
                    Terminé — L'affectation est terminée
                </option>
            </select>
            @error('statut')
                <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p>
            @enderror
        </div>
    </div>

</div>
```

## resources/views/admin/affectations/partials/show.blade.php

```blade
<div class="space-y-4">

    {{-- Formateur --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
        <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Formateur</div>
        <a href="{{ route('admin.formateurs.show', $affectation->formateur->id ?? 0) }}"
           class="flex items-center gap-3 group">
            <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center">
                <span class="text-brand-700 font-bold text-lg">
                    {{ strtoupper(substr($affectation->formateur->prenom ?? 'U', 0, 1) . substr($affectation->formateur->nom ?? 'N', 0, 1)) }}
                </span>
            </div>
            <div>
                <div class="font-bold text-slate-900 group-hover:text-brand-700">
                    {{ $affectation->formateur->nom ?? '—' }} {{ $affectation->formateur->prenom ?? '' }}
                </div>
                <div class="text-xs text-slate-500 font-mono">{{ $affectation->formateur->matricule ?? '' }}</div>
            </div>
        </a>
    </div>

    {{-- Filière + Établissement --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Filière</div>
            <div class="font-semibold text-slate-900">{{ $affectation->filiere->libelle ?? '—' }}</div>
            <div class="text-xs text-slate-500 font-mono">{{ $affectation->filiere->code ?? '' }}</div>
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Établissement</div>
            <div class="font-semibold text-slate-900">{{ $affectation->etablissement->nom ?? '—' }}</div>
            <div class="text-xs text-slate-500">{{ $affectation->etablissement->region ?? '' }}</div>
        </div>
    </div>

    {{-- Période + Statut --}}
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Période</div>
            <div class="text-sm text-slate-900">
                Du <strong>{{ $affectation->date_debut?->format('d/m/Y') }}</strong>
                @if($affectation->date_fin)
                    au <strong>{{ $affectation->date_fin->format('d/m/Y') }}</strong>
                @else
                    <span class="text-brand-700 font-semibold">— En cours</span>
                @endif
            </div>
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Statut</div>
            @if($affectation->statut === 'actif')
                <span class="badge-success">Actif</span>
            @elseif($affectation->statut === 'termine')
                <span class="badge-gray">Terminé</span>
            @else
                <span class="badge-warning">Suspendu</span>
            @endif
        </div>
    </div>

</div>
```

## resources/views/admin/affectations/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Détail affectation')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.affectations.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">Détail de l'affectation</h1>
            <p class="text-sm text-slate-500 mt-1">Créée le {{ $affectation->created_at?->format('d/m/Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.affectations.edit', $affectation->id) }}" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">edit</span>
                Modifier
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Fiche formateur --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Formateur</div>
        <div class="flex items-center gap-3 mb-3">
            <div class="avatar avatar-md avatar-primary">
                {{ strtoupper(substr($affectation->formateur->prenom ?? 'U', 0, 1) . substr($affectation->formateur->nom ?? 'N', 0, 1)) }}
            </div>
            <div>
                <div class="font-semibold">{{ $affectation->formateur->nom ?? '—' }} {{ $affectation->formateur->prenom ?? '' }}</div>
                <div class="text-[11px] text-slate-500 font-mono">{{ $affectation->formateur->matricule ?? '' }}</div>
            </div>
        </div>
        <a href="{{ route('admin.formateurs.show', $affectation->formateur->id ?? 0) }}"
           class="text-[12px] font-semibold text-brand-700 hover:text-brand-800 inline-flex items-center gap-1">
            Voir le profil complet
            <span class="material-symbols-rounded text-[14px]">arrow_forward</span>
        </a>
    </div>

    {{-- Filière --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Filière</div>
        <div class="font-semibold">{{ $affectation->filiere->libelle ?? '—' }}</div>
        <div class="text-[11px] text-slate-500 font-mono">{{ $affectation->filiere->code ?? '' }}</div>
    </div>

    {{-- Établissement --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Établissement</div>
        <div class="font-semibold">{{ $affectation->etablissement->nom ?? '—' }}</div>
        <div class="text-[11px] text-slate-500">{{ $affectation->etablissement->region ?? '' }}</div>
    </div>

    {{-- Période --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Période</div>
        <div class="text-sm">
            Du <strong>{{ $affectation->date_debut?->format('d/m/Y') }}</strong>
            @if($affectation->date_fin)
                au <strong>{{ $affectation->date_fin->format('d/m/Y') }}</strong>
            @else
                <span class="badge-success ml-2">En cours</span>
            @endif
        </div>
    </div>

    {{-- Statut --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Statut</div>
        @if($affectation->statut === 'actif')
            <span class="badge-success">Actif</span>
        @elseif($affectation->statut === 'termine')
            <span class="badge-gray">Terminé</span>
        @else
            <span class="badge-warning">Suspendu</span>
        @endif
    </div>

</div>

@endsection
```

## resources/views/admin/dashboard/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Tableau de bord</h1>
    <p class="text-sm text-slate-500 mt-1">Vue d'ensemble de la gestion des formateurs</p>
</div>

{{-- ============ STATISTIQUES ============ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <div class="stat-card">
        <div class="stat-icon bg-emerald-50">
            <span class="material-symbols-rounded text-emerald-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">groups</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $stats['formateurs'] ?? 128 }}</div>
            <div class="stat-label">Formateurs</div>
            <div class="stat-trend-up mt-1">
                <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                +12% ce mois
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-teal-50">
            <span class="material-symbols-rounded text-teal-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">apartment</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $stats['etablissements'] ?? 8 }}</div>
            <div class="stat-label">Établissements</div>
            <div class="stat-trend-up mt-1">
                <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                +3% ce mois
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-green-50">
            <span class="material-symbols-rounded text-green-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $stats['filieres'] ?? 24 }}</div>
            <div class="stat-label">Filières</div>
            <div class="stat-trend-up mt-1">
                <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                +5% ce mois
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon bg-lime-50">
            <span class="material-symbols-rounded text-lime-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">event</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $stats['sessions'] ?? 36 }}</div>
            <div class="stat-label">Sessions</div>
            <div class="stat-trend-up mt-1">
                <span class="material-symbols-rounded text-[12px] align-middle">trending_up</span>
                +3% ce mois
            </div>
        </div>
    </div>
</div>

{{-- ============ GRAPHIQUE ÉVOLUTION DES AFFECTATIONS ============ --}}
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-display font-bold text-slate-900">Évolution des affectations</h2>
        <select class="text-xs border border-slate-200 rounded-lg px-2 py-1
                       bg-white text-slate-600 outline-none">
            <option>6 derniers mois</option>
            <option>12 derniers mois</option>
        </select>
    </div>
    <div class="h-56">
        <canvas id="chartAffectations"></canvas>
    </div>
</div>

{{-- ============ DERNIÈRES AFFECTATIONS ============ --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-200 flex justify-between items-center">
        <h2 class="font-display font-bold text-slate-900">Dernières affectations</h2>
        <a href="{{ route('admin.affectations.index') }}"
           class="text-xs font-semibold text-brand-700 hover:text-brand-800">
            Voir tout →
        </a>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\Infrastructure\Persistence\Eloquent\Models\AffectationModel::with(['formateur','filiere','etablissement'])->latest()->take(5)->get() as $a)
            <tr>
                <td class="font-semibold">
                    {{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}
                </td>
                <td>{{ $a->filiere->libelle ?? '-' }}</td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td class="text-xs">
                    {{ $a->date_debut?->format('d/m/Y') }}
                    → {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}
                </td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'termine')
                        <span class="badge-gray">Terminé</span>
                    @else
                        <span class="badge-warning">Suspendu</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartAffectations'), {
        type: 'line',
        data: {
            labels: ['Fév','Mar','Avr','Mai','Juin','Juil','Août'],
            datasets: [{
                label: 'Affectations',
                data: [12, 19, 15, 25, 22, 30, 36],
                borderColor: '#059669',
                backgroundColor: 'rgba(5,150,105,0.1)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointBackgroundColor: '#059669',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush

@endsection
```

## resources/views/admin/etablissements/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouvel établissement')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.etablissements.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">Ajouter un établissement</h1>
    <p class="text-sm text-slate-500 mt-1">Remplissez les informations de l'établissement</p>
</div>

<form method="POST" action="{{ route('admin.etablissements.store') }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf

    @include('admin.etablissements.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.etablissements.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>

@endsection
```

## resources/views/admin/etablissements/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier établissement')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.etablissements.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">
        Modifier : {{ $etablissement->nom }}
    </h1>
    <p class="text-sm text-slate-500 mt-1">Code : {{ $etablissement->code }}</p>
</div>

<form method="POST" action="{{ route('admin.etablissements.update', $etablissement->id) }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf
    @method('PUT')

    @include('admin.etablissements.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.etablissements.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Mettre à jour
        </button>
    </div>
</form>

@endsection
```

## resources/views/admin/etablissements/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Établissements')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Établissements</h1>
        <p class="text-sm text-slate-500 mt-1">Gestion des établissements de formation</p>
    </div>
    <a href="{{ route('admin.etablissements.create') }}" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter un établissement
    </a>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <span class="absolute left-3 top-1/2 -translate-y-1/2
                         material-symbols-rounded text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher (code, nom, région, contact...)"
                   class="form-input pl-10">
        </div>
        <select name="type" class="form-input">
            <option value="">Tous les types</option>
            <option value="CFP" @selected(request('type') === 'CFP')>CFP</option>
            <option value="LTP" @selected(request('type') === 'LTP')>LTP</option>
            <option value="Lycee" @selected(request('type') === 'Lycee')>Lycée</option>
            <option value="Autre" @selected(request('type') === 'Autre')>Autre</option>
        </select>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">filter_alt</span>
                Filtrer
            </button>
            <a href="{{ route('admin.etablissements.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-[18px]">restart_alt</span>
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Région</th>
                <th>Contact Responsable</th>
                <th class="text-center">Formateurs</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissements ?? [] as $e)
            <tr>
                <td class="font-mono text-xs font-semibold">{{ $e->code }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.etablissements.show', $e->id) }}"
                       class="hover:text-brand-700 transition">
                        {{ $e->nom }}
                    </a>
                </td>
                <td><span class="badge-info">{{ $e->type }}</span></td>
                <td>{{ $e->region ?? '—' }}</td>
                <td class="text-xs">{{ $e->contact ?? '—' }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.etablissements.show', $e->id) }}#formateurs"
                       class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                              bg-brand-50 text-brand-700 text-xs font-semibold
                              hover:bg-brand-100 transition cursor-pointer">
                        <span class="material-symbols-rounded text-[14px]">groups</span>
                        {{ $e->formateurs_count ?? 0 }}
                    </a>
                </td>
                <td>
                    @if(($e->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($e->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.etablissements.show', $e->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.etablissements.edit', $e->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.etablissements.destroy', $e->id) }}"
                              method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center
                                           text-slate-500 hover:bg-red-50 hover:text-red-600 transition">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-16">
                    <span class="material-symbols-rounded text-5xl text-slate-300 block mb-2">
                        apartment
                    </span>
                    <p class="text-slate-500">Aucun établissement trouvé</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $etablissements->total() ?? 0 }} établissements</span>
        <div>{{ $etablissements->links() }}</div>
    </div>
</div>

@endsection
```

## resources/views/admin/etablissements/partials/form.blade.php

```blade
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code"
               value="{{ old('code', $etablissement->code ?? '') }}"
               class="input-modern font-mono" placeholder="Ex: CFP-001" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
        <input type="text" name="nom"
               value="{{ old('nom', $etablissement->nom ?? '') }}"
               class="input-modern" placeholder="Ex: CFP Antananarivo" required>
        @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
        <select name="type" class="input-modern" required>
            <option value="">— Sélectionner —</option>
            <option value="CFP" @selected(old('type', $etablissement->type ?? '') === 'CFP')>CFP</option>
            <option value="LTP" @selected(old('type', $etablissement->type ?? '') === 'LTP')>LTP</option>
            <option value="Lycee" @selected(old('type', $etablissement->type ?? '') === 'Lycee')>Lycée</option>
            <option value="Autre" @selected(old('type', $etablissement->type ?? '') === 'Autre')>Autre</option>
        </select>
        @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
        <select name="statut" class="input-modern" required>
            <option value="actif" @selected(old('statut', $etablissement->statut ?? 'actif') === 'actif')>Actif</option>
            <option value="inactif" @selected(old('statut', $etablissement->statut ?? '') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(old('statut', $etablissement->statut ?? '') === 'suspendu')>Suspendu</option>
        </select>
        @error('statut') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-400 mt-1">
            Le statut est synchronisé automatiquement selon les formateurs
        </p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Région</label>
        <input type="text" name="region"
               value="{{ old('region', $etablissement->region ?? '') }}"
               class="input-modern" placeholder="Ex: Analamanga">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
        <input type="text" name="adresse"
               value="{{ old('adresse', $etablissement->adresse ?? '') }}"
               class="input-modern" placeholder="Ex: Lot II M 45 Bis, Antananarivo">
    </div>

    <div class="md:col-span-2">
        <h3 class="font-semibold text-gray-700 border-b pb-2 mt-2">Contact</h3>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Contact Responsable de l'établissement
        </label>
        <input type="text" name="contact_responsable"
               value="{{ old('contact_responsable', $etablissement->contact_responsable ?? $etablissement->telephone ?? '') }}"
               class="input-modern"
               placeholder="Ex: M. Rakoto Jean — 034 12 345 67">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email"
               value="{{ old('email', $etablissement->email ?? '') }}"
               class="input-modern" placeholder="contact@cfp-ants.mg">
    </div>

</div>
```

## resources/views/admin/etablissements/show.blade.php

```blade
@extends('layouts.admin')
@section('title', $etablissement->nom)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.etablissements.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">
                {{ $etablissement->nom }}
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Code : <span class="font-mono">{{ $etablissement->code }}</span>
                · Type : <span class="badge-info">{{ $etablissement->type }}</span>
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.pdf.formateurs.par-etablissement', ['etablissement_id' => $etablissement->id]) }}"
               target="_blank" class="btn-outline-primary">
                <span class="material-symbols-rounded text-[18px]">picture_as_pdf</span>
                Export PDF
            </a>
            <a href="{{ route('admin.etablissements.edit', $etablissement->id) }}" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">edit</span>
                Modifier
            </a>
        </div>
    </div>
</div>

{{-- ========== CARTES STATS ========== --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <div class="stat-icon bg-brand-50">
            <span class="material-symbols-rounded text-brand-700 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">groups</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $etablissement->formateurs->count() }}</div>
            <div class="stat-label">Formateurs</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-emerald-50">
            <span class="material-symbols-rounded text-emerald-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">event</span>
        </div>
        <div class="flex-1">
            <div class="stat-value">{{ $etablissement->sessions->count() }}</div>
            <div class="stat-label">Sessions</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-teal-50">
            <span class="material-symbols-rounded text-teal-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">map</span>
        </div>
        <div class="flex-1">
            <div class="stat-value text-xl">{{ $etablissement->region ?? '—' }}</div>
            <div class="stat-label">Région</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-amber-50">
            <span class="material-symbols-rounded text-amber-600 text-2xl"
                  style="font-variation-settings: 'FILL' 1;">contact_phone</span>
        </div>
        <div class="flex-1">
            <div class="stat-value text-sm leading-tight">
                {{ $etablissement->contact ?? '—' }}
            </div>
            <div class="stat-label">Contact Responsable</div>
        </div>
    </div>
</div>

{{-- ========== INFOS DÉTAILLÉES ========== --}}
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
    <h2 class="font-display font-bold text-slate-900 mb-4">Informations</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
        <div>
            <span class="text-slate-500">Adresse :</span>
            <span class="text-slate-800 font-medium">{{ $etablissement->adresse ?? '—' }}</span>
        </div>
        <div>
            <span class="text-slate-500">Email :</span>
            <span class="text-slate-800 font-medium">{{ $etablissement->email ?? '—' }}</span>
        </div>
    </div>
</div>

{{-- ========== FORMATEURS ========== --}}
<div id="formateurs" class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-display font-bold text-slate-900">
            Formateurs de cet établissement ({{ $etablissement->formateurs->count() }})
        </h2>
        <a href="{{ route('admin.formateurs.create') }}?etablissement_id={{ $etablissement->id }}"
           class="text-[12px] font-semibold text-brand-700 hover:text-brand-800">
            + Ajouter un formateur
        </a>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Filière</th>
                <th>Grade</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissement->formateurs as $f)
            <tr>
                <td>
                    <div class="avatar avatar-md avatar-primary">
                        {{ strtoupper(substr($f->prenom ?? 'U', 0, 1) . substr($f->nom ?? 'N', 0, 1)) }}
                    </div>
                </td>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}"
                       class="hover:text-brand-700 transition">
                        {{ $f->nom }} {{ $f->prenom }}
                    </a>
                </td>
                <td class="text-xs">
                    {{ $f->filieres->pluck('libelle')->take(2)->join(', ') ?: '—' }}
                </td>
                <td class="text-xs">{{ $f->grade ?? '—' }}</td>
                <td>
                    @if($f->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($f->statut === 'en_attente')
                        <span class="badge-warning">En attente</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-12 text-slate-400 text-sm">
                    Aucun formateur dans cet établissement
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ========== SESSIONS RÉCENTES ========== --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-display font-bold text-slate-900">Sessions récentes</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Formateur</th>
                <th>Filière</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissement->sessions->take(10) as $s)
            <tr>
                <td class="font-mono text-xs">{{ $s->code }}</td>
                <td class="text-sm">
                    {{ $s->formateur->nom ?? '—' }} {{ $s->formateur->prenom ?? '' }}
                </td>
                <td class="text-sm">{{ $s->filiere->libelle ?? '—' }}</td>
                <td class="text-xs">
                    {{ $s->date_debut?->format('d/m/Y') }} → {{ $s->date_fin?->format('d/m/Y') }}
                </td>
                <td>
                    @if($s->statut === 'active')
                        <span class="badge-success">Active</span>
                    @elseif($s->statut === 'terminee')
                        <span class="badge-gray">Terminée</span>
                    @else
                        <span class="badge-danger">Annulée</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-8 text-slate-400 text-sm">
                    Aucune session
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
```

## resources/views/admin/filieres/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouvelle filière')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.filieres.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">Ajouter une filière</h1>
</div>

<form method="POST" action="{{ route('admin.filieres.store') }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf

    @include('admin.filieres.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.filieres.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>

@endsection
```

## resources/views/admin/filieres/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier filière')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.filieres.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">
        Modifier : {{ $filiere->libelle }}
    </h1>
</div>

<form method="POST" action="{{ route('admin.filieres.update', $filiere->id) }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf
    @method('PUT')

    @include('admin.filieres.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.filieres.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Mettre à jour
        </button>
    </div>
</form>

@endsection
```

## resources/views/admin/filieres/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Filières')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Filières</h1>
        <p class="text-sm text-slate-500 mt-1">Liste des filières de formation</p>
    </div>
    <a href="{{ route('admin.filieres.create') }}" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter une filière
    </a>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="relative md:col-span-2">
            <span class="absolute left-3 top-1/2 -translate-y-1/2
                         material-symbols-rounded text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher une filière (code, libellé...)"
                   class="form-input pl-10">
        </div>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">filter_alt</span>
                Filtrer
            </button>
            <a href="{{ route('admin.filieres.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-[18px]">restart_alt</span>
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Code</th>
                <th>Libellé</th>
                <th>Options</th>
                <th class="text-center">Formateurs</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filieres ?? [] as $f)
            <tr class="cursor-pointer hover:bg-slate-50 transition"
                onclick="window.location='{{ route('admin.filieres.show', $f->id) }}'">

                <td class="font-mono text-xs font-semibold">{{ $f->code }}</td>

                <td class="font-semibold text-slate-800">
                    {{ $f->libelle }}
                </td>

                <td>
                    @if($f->options && $f->options->count())
                        <span class="badge-gray">{{ $f->options->count() }} option(s)</span>
                    @else
                        <span class="text-slate-400">—</span>
                    @endif
                </td>

                <td class="text-center">
                    <a href="{{ route('admin.filieres.show', $f->id) }}#formateurs"
                       onclick="event.stopPropagation()"
                       class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                              bg-brand-50 text-brand-700 text-xs font-semibold
                              hover:bg-brand-100 transition cursor-pointer">
                        <span class="material-symbols-rounded text-[14px]">groups</span>
                        {{ $f->formateurs_count ?? 0 }}
                    </a>
                </td>

                <td onclick="event.stopPropagation()">
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>

                <td>
                    <div class="flex items-center justify-end gap-1" onclick="event.stopPropagation()">
                        <a href="{{ route('admin.filieres.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition"
                           title="Voir">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.filieres.edit', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition"
                           title="Modifier">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.filieres.destroy', $f->id) }}"
                              method="POST" class="inline"
                              onsubmit="event.stopPropagation(); return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center
                                           text-slate-500 hover:bg-red-50 hover:text-red-600 transition"
                                    title="Supprimer">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-16">
                    <span class="material-symbols-rounded text-5xl text-slate-300 block mb-2">
                        school
                    </span>
                    <p class="text-slate-500">Aucune filière trouvée</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $filieres->total() ?? 0 }} filières</span>
        <div>{{ $filieres->links() }}</div>
    </div>
</div>

@endsection
```

## resources/views/admin/filieres/partials/form.blade.php

```blade
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code"
               value="{{ old('code', $filiere->code ?? '') }}"
               class="input-modern" placeholder="Ex: INFO-L2" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Libellé *</label>
        <input type="text" name="libelle"
               value="{{ old('libelle', $filiere->libelle ?? '') }}"
               class="input-modern" placeholder="Ex: Informatique" required>
        @error('libelle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
        <select name="statut" class="input-modern" required>
            <option value="actif" @selected(old('statut', $filiere->statut ?? 'actif') === 'actif')>Actif</option>
            <option value="inactif" @selected(old('statut', $filiere->statut ?? '') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(old('statut', $filiere->statut ?? '') === 'suspendu')>Suspendu</option>
        </select>
        @error('statut') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-400 mt-1">
            Le statut est synchronisé automatiquement selon les formateurs
        </p>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="input-modern">{{ old('description', $filiere->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    @if(!isset($filiere))
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Options (une par ligne)
        </label>
        <textarea name="options_text" rows="4" class="input-modern"
                  placeholder="Ex:&#10;Génie Logiciel&#10;Réseaux et Télécommunications&#10;Sécurité Informatique"></textarea>
        <p class="text-xs text-gray-400 mt-1">Chaque ligne deviendra une option de la filière.</p>
    </div>
    @endif

</div>
```

## resources/views/admin/filieres/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Détail filière')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.filieres.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">{{ $filiere->libelle }}</h1>
            <p class="text-sm text-slate-500 mt-1">
                Code : <span class="font-mono">{{ $filiere->code }}</span>
            </p>
        </div>
        <a href="{{ route('admin.filieres.edit', $filiere->id) }}" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">edit</span>
            Modifier
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Formateurs</div>
        <div class="font-display text-3xl font-bold text-brand-700">
            {{ $filiere->formateurs->count() }}
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Options</div>
        <div class="font-display text-3xl font-bold text-brand-700">
            {{ $filiere->options->count() }}
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[12px] text-slate-500 mb-1">Code</div>
        <div class="font-mono text-xl font-bold text-brand-700">
            {{ $filiere->code }}
        </div>
    </div>
</div>

@if($filiere->description)
<div class="bg-white rounded-xl border border-slate-200 p-5 mb-6">
    <div class="text-[12px] font-semibold text-slate-500 uppercase mb-2">Description</div>
    <p class="text-sm text-slate-700">{{ $filiere->description }}</p>
</div>
@endif

{{-- Options --}}
@if($filiere->options->count())
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="font-display font-bold text-slate-900">Options</h2>
    </div>
    <ul class="divide-y divide-slate-100">
        @foreach($filiere->options as $option)
            <li class="px-5 py-3 text-sm text-slate-700">{{ $option->libelle }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Formateurs --}}
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
        <h2 class="font-display font-bold text-slate-900">
            Formateurs de cette filière ({{ $filiere->formateurs->count() }})
        </h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filiere->formateurs as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}"
                       class="hover:text-brand-700 transition">
                        {{ $f->nom }} {{ $f->prenom }}
                    </a>
                </td>
                <td>{{ $f->etablissement->nom ?? '—' }}</td>
                <td>
                    @if($f->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @else
                        <span class="badge-danger">{{ $f->statut }}</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}"
                           class="w-8 h-8 rounded-lg flex items-center justify-center
                                  text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-12 text-slate-400 text-sm">
                    Aucun formateur affecté à cette filière
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
```

## resources/views/admin/formateurs/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouveau formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Ajouter un formateur</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/formateurs/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier formateur')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
    <h1 class="font-display text-2xl font-bold text-slate-900 mt-2">Modifier : {{ $formateur->nom }} {{ $formateur->prenom }}</h1>
</div>

<form method="POST" action="{{ route('admin.formateurs.update', $formateur->id) }}" class="bg-white rounded-xl border border-slate-200 p-6 max-w-3xl mx-auto">
    @csrf
    @method('PUT')
    @include('admin.formateurs.partials.form')

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Annuler</a>
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Mettre à jour
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/formateurs/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Formateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Formateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Liste de tous les formateurs du réseau</p>
    </div>
    <button type="button" onclick="openFormateurModal()" class="btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>
        Ajouter un formateur
    </button>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un formateur..." class="form-input pl-10">
        </div>
        <select name="etablissement_id" class="form-input">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>{{ $e->nom }}</option>
            @endforeach
        </select>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="actif" @selected(request('statut') === 'actif')>Actif</option>
            <option value="inactif" @selected(request('statut') === 'inactif')>Inactif</option>
            <option value="suspendu" @selected(request('statut') === 'suspendu')>Suspendu</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Établissement</th>
                <th>Filière</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateurs ?? [] as $f)
            <tr>
                <td class="font-mono text-xs">{{ $f->matricule }}</td>
                <td class="font-semibold">
                    <a href="{{ route('admin.formateurs.show', $f->id) }}" class="hover:text-brand-700">{{ $f->nom }} {{ $f->prenom }}</a>
                </td>
                <td>{{ $f->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $f->filiere->libelle ?? '—' }}</td>
                <td>
                    @if(($f->statut ?? 'actif') === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif(($f->statut ?? '') === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.formateurs.show', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.formateurs.edit', $f->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50">
                            <span class="material-symbols-rounded text-[18px]">edit</span>
                        </a>
                        <form action="{{ route('admin.formateurs.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50">
                                <span class="material-symbols-rounded text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-16 text-slate-400">Aucun formateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $formateurs->total() ?? 0 }} formateurs</span>
        <div>{{ $formateurs->links() }}</div>
    </div>
</div>

{{-- ========== MODAL AJOUTER (z-index MAX) ========== --}}
<div id="formateurModal"
     style="display: none; position: fixed !important; inset: 0 !important; z-index: 2147483647 !important; align-items: center; justify-content: center; padding: 1rem;"
     onclick="if(event.target === this) closeFormateurModal()">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" style="z-index: 1;"></div>

    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
         style="z-index: 2; max-height: calc(100vh - 2rem);">

        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-md">
                    <span class="material-symbols-rounded text-white text-xl" style="font-variation-settings: 'FILL' 1;">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Ajouter un formateur</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Le statut sera propagé à toutes les tables liées</p>
                </div>
            </div>
            <button type="button" onclick="closeFormateurModal()"
                    class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition">
                <span class="material-symbols-rounded text-[20px]">close</span>
            </button>
        </div>

        <form id="formateurForm" method="POST" action="{{ route('admin.formateurs.store') }}"
              class="flex flex-col flex-1 min-h-0">
            @csrf

            <div id="formateurFormContent"
                 class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden px-6 py-5">
                <div class="text-center py-16 text-slate-400">
                    <span class="material-symbols-rounded text-4xl animate-spin block mb-3">progress_activity</span>
                    <p class="text-sm">Chargement du formulaire...</p>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-end gap-2 bg-slate-50 rounded-b-2xl shrink-0">
                <button type="button" onclick="closeFormateurModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary" id="submitBtn">
                    <span class="material-symbols-rounded text-[18px]">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ===== MODAL AU-DESSUS DE TOUT ===== */
    #formateurModal:not(.hidden) {
        display: flex !important;
    }

    #formateurModal > .absolute {
        z-index: 1 !important;
    }

    #formateurModal > .relative {
        z-index: 2 !important;
        position: relative;
    }

    #formateurForm {
        display: flex;
        flex-direction: column;
        flex: 1 1 auto;
        min-height: 0;
        overflow: hidden;
    }

    #formateurFormContent {
        flex: 1 1 auto;
        min-height: 0;
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    #formateurFormContent::-webkit-scrollbar { width: 8px; }
    #formateurFormContent::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #formateurFormContent::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ===== BLOQUER TOUT LE RESTE ===== */
    body.modal-open {
        overflow: hidden !important;
    }

    body.modal-open > *:not(#formateurModal) {
        pointer-events: none !important;
        user-select: none !important;
    }

    body.modal-open #formateurModal,
    body.modal-open #formateurModal * {
        pointer-events: auto !important;
        user-select: auto !important;
    }
</style>

<script>
    console.log('✅ Script formateur chargé');

    let savedScrollPosition = 0;

    function openFormateurModal() {
        console.log('🔵 Ouverture modal');
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        savedScrollPosition = window.scrollY || document.documentElement.scrollTop;

        modal.style.display = 'flex';
        modal.classList.remove('hidden');

        document.body.classList.add('modal-open');
        document.body.style.position = 'fixed';
        document.body.style.top = `-${savedScrollPosition}px`;
        document.body.style.left = '0';
        document.body.style.right = '0';
        document.body.style.width = '100%';

        fetch('{{ route("admin.formateurs.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            console.log('📦 Formulaire chargé');
            document.getElementById('formateurFormContent').innerHTML = data.html;
        })
        .catch(err => {
            console.error('❌ Erreur chargement:', err);
            document.getElementById('formateurFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur : ' + err.message + '</div>';
        });
    }

    function closeFormateurModal() {
        console.log('🔴 Fermeture modal');
        const modal = document.getElementById('formateurModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.style.display = 'none';

        document.body.classList.remove('modal-open');
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.right = '';
        document.body.style.width = '';

        window.scrollTo(0, savedScrollPosition);
    }

    // =====================================================
    // DÉLÉGATION SUR LE CLIC DU BOUTON ENREGISTRER (principal)
    // =====================================================
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('#submitBtn');
        if (!btn) return;

        e.preventDefault();
        console.log('🖱️ Clic sur Enregistrer détecté');

        const form = document.getElementById('formateurForm');
        if (!form) {
            console.error('❌ Formulaire introuvable');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-[18px] animate-spin">progress_activity</span> Enregistrement...';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,
        })
        .then(r => {
            console.log('📡 Réponse HTTP:', r.status);
            return r.json();
        })
        .then(data => {
            console.log('📦 Data reçue:', data);

            if (data.success) {
                console.log('✅ Succès - Redirection vers:', data.redirect);
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('❌ Erreur:', err);
            alert('Erreur lors de l\'enregistrement : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // =====================================================
    // DÉLÉGATION SUR LE SUBMIT (fallback)
    // =====================================================
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'formateurForm') return;

        e.preventDefault();
        console.log('📤 Soumission AJAX détectée (submit)');
    });

    // Fermer avec Échap
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            const modal = document.getElementById('formateurModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeFormateurModal();
            }
        }
    });
</script>

@endsection
```

## resources/views/admin/formateurs/partials/filters.blade.php

```blade
<form action="{{ route('admin.formateurs.index') }}" method="GET" class="bg-white rounded-2xl shadow-soft p-4 md:p-6 mb-6 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}"
                   class="input-modern pl-10">
        </div>
        <div>
            <select name="etablissement_id" class="input-modern">
                <option value="">Tous les établissements</option>
                @foreach($etablissements ?? [] as $etablissement)
                    <option value="{{ $etablissement->id }}" {{ request('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                        {{ $etablissement->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="statut" class="input-modern">
                <option value="">Tous les statuts</option>
                <option value="actif" {{ request('statut') == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ request('statut') == 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn-primary text-sm flex-1">
                <span class="material-symbols-outlined text-lg">search</span>
                Filtrer
            </button>
            <a href="{{ route('admin.formateurs.index') }}" class="btn-outline-primary text-sm">
                <span class="material-symbols-outlined text-lg">filter_alt_off</span>
            </a>
        </div>
    </div>
</form>
```

## resources/views/admin/formateurs/partials/form.blade.php

```blade
@php
    $grades = [
        'Assistant', 'Assistant Principal', 'Maitre-Assistant',
        'Maitre de Conferences', 'Professeur Habilité',
        'Professeur de l\'Enseignement Supérieur', 'Professeur Titulaire',
        'Vacataire', 'Contractuel',
    ];
@endphp

<style>
    .form-field { width:100%; padding:0.75rem 1rem; font-size:0.9375rem; line-height:1.5; color:#0f172a; background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.5rem; transition:all 0.15s ease; font-family:inherit; }
    .form-field::placeholder { color:#94a3b8; }
    .form-field:focus { outline:none; border-color:#059669; box-shadow:0 0 0 3px rgba(5,150,105,0.12); }
    .form-field:read-only, .form-field:disabled { background-color:#f8fafc; color:#64748b; cursor:not-allowed; }
    .form-label { display:block; font-size:0.875rem; font-weight:600; color:#1e293b; margin-bottom:0.375rem; }
    .form-label .required { color:#ef4444; margin-left:0.125rem; }
    .form-hint { font-size:0.75rem; color:#64748b; margin-top:0.375rem; }
    .form-card { background-color:#fff; border:1.5px solid #e2e8f0; border-radius:0.75rem; padding:1.25rem; }
    .form-card + .form-card { margin-top:1rem; }
    .form-card-header { display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px dashed #e2e8f0; }
    .form-card-icon { width:1.75rem; height:1.75rem; display:inline-flex; align-items:center; justify-content:center; background:#d1fae5; color:#059669; border-radius:0.5rem; font-size:1.125rem; }
    .form-card-title { font-size:0.8125rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:0.05em; }
    .form-error { font-size:0.75rem; color:#ef4444; margin-top:0.25rem; }
</style>

<div class="space-y-4">

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">badge</span>
            <span class="form-card-title">Identité</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Matricule <span class="required">*</span> <span class="text-xs font-normal text-emerald-600 ml-1">(auto-généré)</span></label>
                <input type="text" name="matricule" value="{{ old('matricule', $formateur->matricule ?? ($nextMatricule ?? '')) }}" class="form-field font-mono" readonly required>
                @error('matricule') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $formateur->nom ?? '') }}" class="form-field" placeholder="Ex: RAKOTO" required>
                @error('nom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Prénom <span class="required">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom ?? '') }}" class="form-field" placeholder="Ex: Jean" required>
                @error('prenom') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Sexe</label>
                <select name="sexe" class="form-field">
                    <option value="">— Sélectionner —</option>
                    <option value="Masculin" @selected(old('sexe', $formateur->sexe ?? '') === 'Masculin')>Masculin</option>
                    <option value="Feminin" @selected(old('sexe', $formateur->sexe ?? '') === 'Feminin')>Féminin</option>
                </select>
            </div>
            <div>
                <label class="form-label">CIN</label>
                <input type="text" name="cin" value="{{ old('cin', $formateur->cin ?? '') }}" class="form-field" placeholder="Ex: 101234567890">
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($formateur) && $formateur->date_naissance ? $formateur->date_naissance->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">toggle_on</span>
            <span class="form-card-title">Statut global</span>
        </div>
        <div>
            <label class="form-label">Statut <span class="required">*</span></label>
            <select name="statut" class="form-field" required>
                <option value="actif" @selected(old('statut', $formateur->statut ?? 'actif') === 'actif')>Actif — Le formateur est en activité</option>
                <option value="inactif" @selected(old('statut', $formateur->statut ?? '') === 'inactif')>Inactif — Le formateur a terminé</option>
                <option value="suspendu" @selected(old('statut', $formateur->statut ?? '') === 'suspendu')>Suspendu — Le formateur est en pause</option>
            </select>
            <p class="form-hint">Ce statut sera appliqué au formateur, ses affectations, sessions, établissement et filière</p>
            @error('statut') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">link</span>
            <span class="form-card-title">Affectation</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="form-label">Établissement</label>
                <select name="etablissement_id" class="form-field">
                    <option value="">— Aucun —</option>
                    @foreach($etablissements ?? [] as $etablissement)
                        <option value="{{ $etablissement->id }}" @selected(old('etablissement_id', $formateur->etablissement_id ?? '') == $etablissement->id)>{{ $etablissement->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Filière</label>
                <select name="filiere_id" class="form-field">
                    <option value="">— Aucune —</option>
                    @foreach($filieres ?? [] as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id', $formateur->filiere_id ?? '') == $filiere->id)>{{ $filiere->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Grade <span class="required">*</span></label>
                <select name="grade" class="form-field" required>
                    <option value="">— Sélectionner —</option>
                    @foreach($grades as $g)
                        <option value="{{ $g }}" @selected(old('grade', $formateur->grade ?? '') === $g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('grade') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Date de recrutement</label>
                <input type="date" name="date_recrutement" value="{{ old('date_recrutement', isset($formateur) && $formateur->date_recrutement ? $formateur->date_recrutement->format('Y-m-d') : '') }}" class="form-field">
            </div>
        </div>
    </div>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon material-symbols-rounded">contact_mail</span>
            <span class="form-card-title">Coordonnées</span>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="form-label">Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email', $formateur->email ?? '') }}" class="form-field" placeholder="Ex: jean.rakoto@example.com" required>
                @error('email') <p class="form-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone ?? '') }}" class="form-field" placeholder="Ex: 034 12 345 67">
            </div>
            <div>
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" value="{{ old('adresse', $formateur->adresse ?? '') }}" class="form-field" placeholder="Ex: Lot II M 45 Bis, Antananarivo">
            </div>
        </div>
    </div>

</div>
```

## resources/views/admin/formateurs/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Fiche formateur')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.formateurs.index') }}" class="text-[12px] text-slate-500 hover:text-brand-700">Retour à la liste</a>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-brand-400 to-brand-700 flex items-center justify-center shrink-0">
            <span class="text-white text-3xl font-bold">
                {{ strtoupper(substr($formateur->prenom ?? 'U', 0, 1) . substr($formateur->nom ?? 'N', 0, 1)) }}
            </span>
        </div>
        <div class="flex-1">
            <h1 class="font-display text-2xl font-bold text-slate-900">{{ $formateur->nom }} {{ $formateur->prenom }}</h1>
            <div class="text-[13px] text-slate-500 mt-2 flex flex-wrap gap-4">
                <span>Matricule : <span class="font-mono">{{ $formateur->matricule }}</span></span>
                @if($formateur->grade)
                    <span>Grade : {{ $formateur->grade }}</span>
                @endif
            </div>
        </div>
        <div>
            @if($formateur->statut === 'actif')
                <span class="badge-success">Actif</span>
            @elseif($formateur->statut === 'suspendu')
                <span class="badge-warning">Suspendu</span>
            @else
                <span class="badge-danger">Inactif</span>
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Informations</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Email :</span> {{ $formateur->email ?? '—' }}</div>
            <div><span class="text-slate-500">Téléphone :</span> {{ $formateur->telephone ?? '—' }}</div>
            <div><span class="text-slate-500">Grade :</span> {{ $formateur->grade ?? '—' }}</div>
            <div><span class="text-slate-500">CIN :</span> {{ $formateur->cin ?? '—' }}</div>
            <div><span class="text-slate-500">Sexe :</span> {{ $formateur->sexe ?? '—' }}</div>
            <div><span class="text-slate-500">Date naissance :</span> {{ $formateur->date_naissance?->format('d/m/Y') ?? '—' }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-bold text-slate-900 mb-4">Filière</h2>
        @if($formateur->filiere)
            <a href="{{ route('admin.filieres.show', $formateur->filiere->id) }}" class="block p-3 rounded-lg bg-slate-50 hover:bg-brand-50">
                {{ $formateur->filiere->libelle }}
            </a>
        @else
            <p class="text-slate-400 text-sm">Aucune filière</p>
        @endif
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden mb-6">
    <div class="px-5 py-4 border-b">
        <h2 class="font-bold text-slate-900">Affectations ({{ $formateur->affectations->count() }})</h2>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Période</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formateur->affectations as $a)
            <tr>
                <td>{{ $a->filiere->libelle ?? '—' }}</td>
                <td>{{ $a->etablissement->nom ?? '—' }}</td>
                <td class="text-xs">{{ $a->date_debut?->format('d/m/Y') }} → {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td>
                    @if($a->statut === 'actif')
                        <span class="badge-success">Actif</span>
                    @elseif($a->statut === 'suspendu')
                        <span class="badge-warning">Suspendu</span>
                    @else
                        <span class="badge-gray">Inactif</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-8 text-slate-400">Aucune affectation</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
```

## resources/views/admin/niveaux/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouveau niveau')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.niveaux.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Nouveau niveau</h1>
</div>

<form action="{{ route('admin.niveaux.store') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Libellé *</label>
                <input type="text" name="libelle" value="{{ old('libelle') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none transition-all focus:border-primary-500 focus:ring-4 focus:ring-primary-50">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Code *</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="ex: BAC" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.niveaux.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Enregistrer
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/niveaux/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier le niveau')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.niveaux.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Modifier : {{ $niveau->libelle }}</h1>
</div>

<form action="{{ route('admin.niveaux.update', $niveau->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Libellé *</label>
                <input type="text" name="libelle" value="{{ old('libelle', $niveau->libelle) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Code *</label>
                <input type="text" name="code" value="{{ old('code', $niveau->code) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">{{ old('description', $niveau->description) }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.niveaux.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Mettre à jour
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/niveaux/index.blade.php

```blade
@extends('layouts.admin')

@section('title', 'Gestion des Niveaux')

@section('content')
<div class="p-6 lg:p-8 max-w-7xl mx-auto animate-slide-up">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-green-700 text-3xl p-2 bg-green-50 rounded-xl">stairs</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800">Gestion des Niveaux</h1>
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $niveaux->count() }}
                </span>
            </div>
            <p class="text-gray-500 mt-1">Gérez les niveaux d'études.</p>
        </div>
        <a href="{{ route('admin.niveaux.create') }}" class="btn-primary text-sm inline-flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            Nouveau Niveau
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-2 animate-slide-in">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($niveaux as $niveau)
        <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 hover:shadow-hover transition-all group">
            <div class="flex items-start justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-700">
                    <span class="material-symbols-outlined text-2xl">stairs</span>
                </div>
                <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.niveaux.show', $niveau->id) }}" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-green-600">
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="{{ route('admin.niveaux.edit', $niveau->id) }}" class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-green-600">
                        <span class="material-symbols-outlined">edit</span>
                    </a>
                    <form action="{{ route('admin.niveaux.destroy', $niveau->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            <h3 class="font-bold text-gray-800">{{ $niveau->libelle ?? '-' }}</h3>
            <p class="text-sm text-gray-500 mt-1 font-mono">{{ $niveau->code ?? '' }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $niveau->filieres_count ?? 0 }} filière(s)</p>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <span class="material-symbols-outlined text-5xl text-gray-300 block mb-2">stairs</span>
            <p class="text-gray-500">Aucun niveau trouvé.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
```

## resources/views/admin/niveaux/partials/form.blade.php

```blade
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Libellé *</label>
        <input type="text" name="libelle" value="{{ old('libelle', $niveau->libelle ?? '') }}" class="input-modern" required>
        @error('libelle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code" value="{{ old('code', $niveau->code ?? '') }}" class="input-modern" placeholder="ex: BAC" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="input-modern">{{ old('description', $niveau->description ?? '') }}</textarea>
        @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>
```

## resources/views/admin/niveaux/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Détails du niveau')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.niveaux.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Détails du niveau</h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Libellé</p>
            <p class="font-semibold text-slate-900">{{ $niveau->libelle }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Code</p>
            <p class="font-semibold text-slate-900 font-mono">{{ $niveau->code }}</p>
        </div>
        <div class="md:col-span-2">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Description</p>
            <p class="text-slate-700">{{ $niveau->description ?? 'Aucune description' }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="font-display font-bold text-lg text-slate-900">
            Filières rattachées ({{ $niveau->filieres->count() ?? 0 }})
        </h3>
    </div>
    <div class="p-4">
        @forelse($niveau->filieres ?? [] as $f)
            <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition">
                <div>
                    <p class="font-semibold text-slate-900 text-sm">{{ $f->libelle }}</p>
                    <p class="text-xs text-slate-500 font-mono">{{ $f->code }}</p>
                </div>
                <a href="{{ route('admin.filieres.show', $f->id) }}" class="text-primary-700 hover:text-primary-500 text-sm font-semibold">Voir →</a>
            </div>
        @empty
            <p class="text-sm text-slate-500 p-4">Aucune filière rattachée.</p>
        @endforelse
    </div>
</div>

<a href="{{ route('admin.niveaux.edit', $niveau->id) }}" class="btn btn-primary">
    <span class="material-symbols-rounded text-[18px]">edit</span>Modifier
</a>
@endsection
```

## resources/views/admin/notifications/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Notifications')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg">
                <span class="material-symbols-rounded text-white text-3xl" style="font-variation-settings: 'FILL' 1;">notifications</span>
            </div>
            <div>
                <h1 class="font-display text-2xl font-bold text-slate-900">Notifications</h1>
                <p class="text-sm text-slate-500 mt-1">Toutes les activités récentes du système</p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            @if($stats['non_lues'] > 0)
                <form method="POST" action="{{ route('admin.notifications.read-all') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        <span class="material-symbols-rounded text-lg">done_all</span>
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
            @if($stats['lues'] > 0)
                <form method="POST" action="{{ route('admin.notifications.destroy-all') }}" class="inline"
                      onsubmit="return confirm('Supprimer toutes les notifications lues ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-secondary text-red-600 hover:bg-red-50">
                        <span class="material-symbols-rounded text-lg">delete_sweep</span>
                        Supprimer les lues
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total</div>
            <div class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Non lues</div>
            <div class="text-2xl font-bold text-brand-700 mt-1">{{ $stats['non_lues'] }}</div>
        </div>
        <div class="bg-white rounded-xl border-2 border-slate-300 p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Lues</div>
            <div class="text-2xl font-bold text-slate-400 mt-1">{{ $stats['lues'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl border-2 border-slate-300 p-4 mb-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher une notification..."
                       class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
            </div>
            <select name="statut" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                <option value="">Tous les statuts</option>
                <option value="non_lues" @selected(request('statut') === 'non_lues')>Non lues</option>
                <option value="lues" @selected(request('statut') === 'lues')>Lues</option>
            </select>
            <select name="type" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                <option value="">Tous les types</option>
                <option value="info" @selected(request('type') === 'info')>Info</option>
                <option value="success" @selected(request('type') === 'success')>Succès</option>
                <option value="warning" @selected(request('type') === 'warning')>Avertissement</option>
                <option value="danger" @selected(request('type') === 'danger')>Danger</option>
            </select>
            <div class="md:col-span-4 flex items-center gap-2">
                <button type="submit" class="btn-primary">Filtrer</button>
                <a href="{{ route('admin.notifications.index') }}" class="btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border-2 border-slate-300 overflow-hidden">
        @forelse($notifications as $notif)
            @php
                $colors = [
                    'info'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200'],
                    'success' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-200'],
                    'warning' => ['bg' => 'bg-amber-50',   'text' => 'text-amber-600',   'border' => 'border-amber-200'],
                    'danger'  => ['bg' => 'bg-red-50',     'text' => 'text-red-600',     'border' => 'border-red-200'],
                ];
                $c = $colors[$notif->type] ?? $colors['info'];
            @endphp

            <div class="flex items-start gap-4 px-5 py-4 border-b border-slate-200 last:border-0 transition {{ $notif->lu ? 'opacity-60' : 'bg-white' }}">
                <div class="w-10 h-10 rounded-lg {{ $c['bg'] }} border {{ $c['border'] }} flex items-center justify-center shrink-0">
                    <span class="material-symbols-rounded {{ $c['text'] }} text-xl">{{ $notif->icone ?? 'info' }}</span>
                </div>

                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <div class="font-bold text-slate-900">{{ $notif->titre }}</div>
                            <div class="text-sm text-slate-600 mt-0.5">{{ $notif->message }}</div>
                        </div>
                        <div class="text-xs text-slate-400 whitespace-nowrap">
                            {{ $notif->created_at?->diffForHumans() }}
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-2">
                        @if($notif->lien)
                            <a href="{{ $notif->lien }}" class="text-xs font-semibold text-brand-700 hover:text-brand-800">
                                Voir →
                            </a>
                        @endif

                        @if(!$notif->lu)
                            <form method="POST" action="{{ route('admin.notifications.mark-read', $notif->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-slate-700">
                                    Marquer comme lu
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.notifications.destroy', $notif->id) }}" class="inline"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-red-500 hover:text-red-700">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <span class="material-symbols-rounded text-5xl text-slate-300 block mb-3">notifications_off</span>
                <p class="text-slate-500">Aucune notification</p>
            </div>
        @endforelse

        @if($notifications->hasPages())
            <div class="px-4 py-3 border-t border-slate-200">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
```

## resources/views/admin/rapports/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Rapports')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center gap-4 mb-6">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center shadow-lg">
            <span class="material-symbols-rounded text-white text-3xl" style="font-variation-settings: 'FILL' 1;">description</span>
        </div>
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-900">Rapports</h1>
            <p class="text-sm text-slate-500 mt-1">Générez vos rapports et listes au format PDF</p>
        </div>
    </div>

    @php
        $rapports = [
            [
                'icon'  => 'groups',
                'titre' => 'Liste des formateurs',
                'desc'  => 'Exporter la liste complète des formateurs du réseau',
                'route' => route('admin.pdf.formateurs'),
            ],
            [
                'icon'  => 'apartment',
                'titre' => 'Formateurs par établissement',
                'desc'  => 'Liste des formateurs regroupés par établissement',
                'route' => route('admin.pdf.formateurs.par-etablissement'),
            ],
            [
                'icon'  => 'school',
                'titre' => 'Formateurs par filière',
                'desc'  => 'Liste des formateurs regroupés par filière',
                'route' => route('admin.pdf.formateurs.par-filiere'),
            ],
            [
                'icon'  => 'assignment_ind',
                'titre' => 'Affectations',
                'desc'  => 'Liste complète des affectations des formateurs',
                'route' => route('admin.pdf.affectations'),
            ],
            [
                'icon'  => 'monitoring',
                'titre' => 'Statistiques globales',
                'desc'  => 'Tableau de bord chiffré et statistiques complètes',
                'route' => route('admin.pdf.statistiques'),
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-8">
        @foreach($rapports as $r)
            <a href="{{ $r['route'] }}" target="_blank"
               class="bg-white rounded-xl border-2 border-slate-300 p-5 flex flex-col gap-3
                      transition-all hover:border-brand-700 hover:shadow-lg group">
                <div class="w-12 h-12 rounded-lg bg-brand-50 flex items-center justify-center">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">{{ $r['icon'] }}</span>
                </div>
                <div class="flex-1">
                    <div class="font-display font-bold text-slate-900">{{ $r['titre'] }}</div>
                    <p class="text-sm text-slate-500 mt-1 leading-relaxed">{{ $r['desc'] }}</p>
                </div>
                <div class="flex items-center gap-1 text-sm font-semibold text-brand-700">
                    Ouvrir le PDF
                    <span class="material-symbols-rounded text-lg group-hover:translate-x-1 transition">arrow_forward</span>
                </div>
            </a>
        @endforeach
    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé — Formateurs</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez la liste avant de générer le PDF</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.formateurs') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les établissements</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous les statuts</option>
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer le PDF
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl border-2 border-slate-300">
            <div class="px-5 py-4 border-b-2 border-slate-200">
                <div class="font-display font-bold text-slate-900">Export personnalisé — Affectations</div>
                <p class="text-sm text-slate-500 mt-0.5">Filtrez les affectations par statut, établissement ou période</p>
            </div>

            <form method="GET" action="{{ route('admin.pdf.affectations') }}" target="_blank"
                  class="p-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Établissement</label>
                    <select name="etablissement_id" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        @foreach($etablissements ?? [] as $e)
                            <option value="{{ $e->id }}">{{ $e->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Statut</label>
                    <select name="statut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                        <option value="">Tous</option>
                        <option value="actif">Actif</option>
                        <option value="termine">Terminé</option>
                        <option value="suspendu">Suspendu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Date début (≥)</label>
                    <input type="date" name="date_debut" class="w-full px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full btn-primary justify-center">
                        <span class="material-symbols-rounded text-lg">picture_as_pdf</span>
                        Générer
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

@endsection
```

## resources/views/admin/secteurs/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouveau secteur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.secteurs.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Nouveau secteur</h1>
</div>

<form action="{{ route('admin.secteurs.store') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Code *</label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="ex: IND" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none transition-all focus:border-primary-500 focus:ring-4 focus:ring-primary-50">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Libellé *</label>
                <input type="text" name="libelle" value="{{ old('libelle') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.secteurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Enregistrer
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/secteurs/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier le secteur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.secteurs.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Modifier : {{ $secteur->libelle }}</h1>
</div>

<form action="{{ route('admin.secteurs.update', $secteur->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Code *</label>
                <input type="text" name="code" value="{{ old('code', $secteur->code) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Libellé *</label>
                <input type="text" name="libelle" value="{{ old('libelle', $secteur->libelle) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.secteurs.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Mettre à jour
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/secteurs/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Secteurs')

@section('content')
<div class="flex flex-col gap-5 mb-8 md:flex-row md:items-center md:justify-between">
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-linear-to-br from-primary-100 to-primary-200 flex items-center justify-center text-primary-700 shrink-0">
            <span class="material-symbols-rounded text-[28px]" style="font-variation-settings: 'FILL' 1;">category</span>
        </div>
        <div>
            <h1 class="font-display text-3xl font-bold text-slate-900">Secteurs</h1>
            <p class="text-sm text-slate-500 mt-1">Gérez les secteurs d'activité</p>
        </div>
    </div>
    <a href="{{ route('admin.secteurs.create') }}" class="btn btn-primary">
        <span class="material-symbols-rounded text-[18px]">add</span>Nouveau secteur
    </a>
</div>

@if(session('success'))
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl mb-6 bg-primary-50 border border-primary-200 text-primary-800 text-sm">
        <span class="material-symbols-rounded">check_circle</span><div>{{ session('success') }}</div>
    </div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Code</th>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Libellé</th>
                <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Filières</th>
                <th class="text-right px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($secteurs as $s)
            <tr class="border-b border-slate-100 hover:bg-primary-50/40 transition-colors last:border-0">
                <td class="px-6 py-4 font-mono text-sm text-slate-700">{{ $s->code }}</td>
                <td class="px-6 py-4 font-semibold text-slate-900 text-sm">{{ $s->libelle }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-primary-50 text-primary-700">
                        {{ $s->filieres_count }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.secteurs.show', $s->id) }}" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-primary-50 hover:text-primary-700 transition">
                            <span class="material-symbols-rounded text-[20px]">visibility</span>
                        </a>
                        <a href="{{ route('admin.secteurs.edit', $s->id) }}" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-primary-50 hover:text-primary-700 transition">
                            <span class="material-symbols-rounded text-[20px]">edit</span>
                        </a>
                        <form action="{{ route('admin.secteurs.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Supprimer ?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600 transition">
                                <span class="material-symbols-rounded text-[20px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-16 text-center">
                <div class="flex flex-col items-center gap-3 text-slate-400">
                    <span class="material-symbols-rounded text-6xl">category</span>
                    <div class="text-[15px] font-semibold text-slate-600">Aucun secteur trouvé</div>
                </div>
            </td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
```

## resources/views/admin/secteurs/partials/form.blade.php

```blade
<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code *</label>
        <input type="text" name="code" value="{{ old('code', $secteur->code ?? '') }}" class="input-modern" placeholder="ex: IND" required>
        @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Libellé *</label>
        <input type="text" name="libelle" value="{{ old('libelle', $secteur->libelle ?? '') }}" class="input-modern" required>
        @error('libelle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>
```

## resources/views/admin/secteurs/show.blade.php

```blade
@extends('layouts.admin')

@section('title', 'Détails du Secteur')

@section('content')
<div class="p-6 lg:p-8 max-w-4xl mx-auto animate-slide-up">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.secteurs.index') }}" class="btn-ghost text-sm">
            <span class="material-symbols-outlined">arrow_back</span>
            Retour
        </a>
        <h1 class="text-2xl font-extrabold text-gray-800">
            <span class="text-gradient-primary">Détails du Secteur</span>
        </h1>
    </div>

    <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500">Libellé</p>
                <p class="font-semibold text-gray-800">{{ $secteur->libelle ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Code</p>
                <p class="font-semibold text-gray-800 font-mono">{{ $secteur->code ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-soft p-6 border border-gray-100 mt-6">
        <h3 class="font-semibold text-gray-700 mb-4">Filières rattachées ({{ $secteur->filieres->count() ?? 0 }})</h3>
        @forelse($secteur->filieres ?? [] as $f)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ $f->libelle }}</p>
                    <p class="text-xs text-gray-500 font-mono">{{ $f->code }}</p>
                </div>
                <a href="{{ route('admin.filieres.show', $f->id) }}" class="text-green-600 hover:underline text-sm">Voir →</a>
            </div>
        @empty
            <p class="text-sm text-gray-500">Aucune filière rattachée.</p>
        @endforelse
    </div>

    <div class="flex items-center gap-3 mt-6">
        <a href="{{ route('admin.secteurs.edit', $secteur->id) }}" class="btn-primary">
            <span class="material-symbols-outlined">edit</span>
            Modifier
        </a>
    </div>
</div>
@endsection
```

## resources/views/admin/sessions/index.blade.php

```blade
$content = @'
@extends('layouts.admin')
@section('title', 'Sessions')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Sessions</h1>
    <p class="text-sm text-slate-500 mt-1">
        Sessions de formation (créées automatiquement depuis les affectations)
    </p>
</div>

<div class="bg-white rounded-xl border border-slate-200 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">
        <div class="relative md:col-span-2">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-rounded text-slate-400 text-[18px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher (code, formateur, matricule...)"
                   class="form-input pl-10">
        </div>
        <select name="statut" class="form-input">
            <option value="">Tous les statuts</option>
            <option value="active" @selected(request('statut') === 'active')>Active</option>
            <option value="terminee" @selected(request('statut') === 'terminee')>Terminée</option>
            <option value="annulee" @selected(request('statut') === 'annulee')>Annulée</option>
        </select>
        <select name="etablissement_id" class="form-input">
            <option value="">Tous les établissements</option>
            @foreach($etablissements ?? [] as $e)
                <option value="{{ $e->id }}" @selected(request('etablissement_id') == $e->id)>
                    {{ $e->nom }}
                </option>
            @endforeach
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">
                <span class="material-symbols-rounded text-[18px]">filter_alt</span>
                Filtrer
            </button>
            <a href="{{ route('admin.sessions.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded text-[18px]">restart_alt</span>
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Formateur</th>
                <th>Établissement</th>
                <th>Filière</th>
                <th>Période</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions ?? [] as $s)
            <tr>
                <td>
                    <a href="{{ route('admin.formateurs.show', $s->formateur->id ?? 0) }}" class="flex items-center gap-3 group">
                        <div class="avatar avatar-sm avatar-primary">
                            {{ strtoupper(substr($s->formateur->prenom ?? 'U', 0, 1) . substr($s->formateur->nom ?? 'N', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm group-hover:text-brand-700 transition">
                                {{ $s->formateur->nom ?? '—' }} {{ $s->formateur->prenom ?? '' }}
                            </div>
                            <div class="text-[10px] text-slate-500 font-mono">
                                {{ $s->formateur->matricule ?? '' }}
                            </div>
                        </div>
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.etablissements.show', $s->etablissement->id ?? 0) }}" class="hover:text-brand-700 transition">
                        {{ $s->etablissement->nom ?? '—' }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.filieres.show', $s->filiere->id ?? 0) }}" class="hover:text-brand-700 transition">
                        {{ $s->filiere->libelle ?? '—' }}
                    </a>
                </td>
                <td class="text-xs">
                    {{ $s->date_debut?->format('d/m/Y') }} → {{ $s->date_fin?->format('d/m/Y') ?? 'En cours' }}
                </td>
                <td>
                    @if($s->estEnCours())
                        <span class="badge-success">En cours</span>
                    @elseif($s->estTerminee() || $s->statut === 'terminee')
                        <span class="badge-gray">Terminée</span>
                    @elseif($s->statut === 'annulee')
                        <span class="badge-danger">Annulée</span>
                    @else
                        <span class="badge-info">À venir</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.sessions.show', $s->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700 transition">
                            <span class="material-symbols-rounded text-[18px]">visibility</span>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-16">
                    <span class="material-symbols-rounded text-5xl text-slate-300 block mb-2">event</span>
                    <p class="text-slate-500">Aucune session</p>
                    <p class="text-xs text-slate-400 mt-1">Les sessions sont créées automatiquement lors de la création d'une affectation.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $sessions->total() ?? 0 }} sessions</span>
        <div>{{ $sessions->links() }}</div>
    </div>
</div>

@endsection
```

## resources/views/admin/sessions/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Détail session')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.sessions.index') }}"
       class="inline-flex items-center gap-1 text-[12px] text-slate-500 hover:text-brand-700 mb-2">
        <span class="material-symbols-rounded text-[16px]">arrow_back</span>
        Retour à la liste
    </a>
    <h1 class="font-display text-2xl font-bold text-slate-900">Détail de la session</h1>
    <p class="text-sm text-slate-500 mt-1 font-mono">{{ $session->code }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    {{-- Formateur --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Formateur</div>
        <div class="flex items-center gap-3 mb-3">
            <div class="avatar avatar-md avatar-primary">
                {{ strtoupper(substr($session->formateur->prenom ?? 'U', 0, 1) . substr($session->formateur->nom ?? 'N', 0, 1)) }}
            </div>
            <div>
                <div class="font-semibold">{{ $session->formateur->nom ?? '—' }} {{ $session->formateur->prenom ?? '' }}</div>
                <div class="text-[11px] text-slate-500 font-mono">{{ $session->formateur->matricule ?? '' }}</div>
            </div>
        </div>
        <a href="{{ route('admin.formateurs.show', $session->formateur->id ?? 0) }}"
           class="text-[12px] font-semibold text-brand-700 hover:text-brand-800 inline-flex items-center gap-1">
            Voir le profil
            <span class="material-symbols-rounded text-[14px]">arrow_forward</span>
        </a>
    </div>

    {{-- Filière --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Filière</div>
        <div class="font-semibold">{{ $session->filiere->libelle ?? '—' }}</div>
        <div class="text-[11px] text-slate-500 font-mono">{{ $session->filiere->code ?? '' }}</div>
    </div>

    {{-- Établissement --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Établissement</div>
        <div class="font-semibold">{{ $session->etablissement->nom ?? '—' }}</div>
        <div class="text-[11px] text-slate-500">{{ $session->etablissement->region ?? '' }}</div>
    </div>

    {{-- Période --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Période</div>
        <div class="text-sm">
            Du <strong>{{ $session->date_debut?->format('d/m/Y') }}</strong><br>
            au <strong>{{ $session->date_fin?->format('d/m/Y') ?? 'En cours' }}</strong>
        </div>
    </div>

    {{-- Statut --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-[11px] font-bold text-slate-500 uppercase mb-3">Statut</div>
        @if($session->estEnCours())
            <span class="badge-success">En cours</span>
        @elseif($session->estTerminee() || $session->statut === 'terminee')
            <span class="badge-gray">Terminée</span>
        @elseif($session->statut === 'annulee')
            <span class="badge-danger">Annulée</span>
        @else
            <span class="badge-info">À venir</span>
        @endif
    </div>

</div>

@if($session->titre || $session->description)
<div class="bg-white rounded-xl border border-slate-200 p-5">
    @if($session->titre)
        <div class="font-semibold text-slate-800 mb-2">{{ $session->titre }}</div>
    @endif
    @if($session->description)
        <p class="text-sm text-slate-600">{{ $session->description }}</p>
    @endif
</div>
@endif

@endsection
```

## resources/views/admin/users/create.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Nouvel utilisateur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Nouvel utilisateur</h1>
</div>

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nom *</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Prénom *</label>
                <input type="text" name="prenom" value="{{ old('prenom') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Rôle *</label>
                <select name="role" required class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
                    <option value="">Sélectionner</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="gestionnaire" {{ old('role') == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                </select>
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Mot de passe *</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Confirmation *</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Enregistrer
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/users/edit.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Modifier l\'utilisateur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Modifier : {{ $user->prenom }} {{ $user->nom }}</h1>
</div>

<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nom *</label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Prénom *</label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Rôle *</label>
                <select name="role" required class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="gestionnaire" {{ old('role', $user->role) == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                </select>
            </div>
            <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nouveau mot de passe (optionnel)</label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 rounded-xl border-[1.5px] border-slate-200 bg-white text-sm outline-none">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>Mettre à jour
        </button>
    </div>
</form>
@endsection
```

## resources/views/admin/users/index.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Utilisateurs')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
    <div>
        <h1 class="font-display text-2xl font-bold text-slate-900">Utilisateurs</h1>
        <p class="text-sm text-slate-500 mt-1">Comptes administrateurs de l'application</p>
    </div>
    @if(auth('admin')->user()->role === 'super_admin')
        <button type="button" onclick="openCreateModal()" class="btn-primary">
            <span class="material-symbols-rounded text-lg">add</span>
            Nouveau compte
        </button>
    @endif
</div>

{{-- Filtres --}}
<div class="bg-white rounded-lg border-2 border-slate-300 p-4 mb-4">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="md:col-span-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Rechercher (nom, prénom, email)..."
                   class="w-full px-4 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-2 focus:ring-brand-100">
        </div>
        <select name="role" class="px-3 py-2.5 text-sm border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700">
            <option value="">Tous les rôles</option>
            <option value="super_admin" @selected(request('role') === 'super_admin')>Super Admin</option>
            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
            <option value="gestionnaire" @selected(request('role') === 'gestionnaire')>Gestionnaire</option>
        </select>
        <div class="flex items-center gap-2">
            <button type="submit" class="btn-primary">Filtrer</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Reset</a>
        </div>
    </form>
</div>

{{-- Tableau --}}
<div class="bg-white rounded-lg border-2 border-slate-300 overflow-hidden">
    <table class="table-modern">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Créé le</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-sm">{{ $user->prenom }} {{ $user->nom }}</div>
                            @if(auth('admin')->id() === $user->id)
                                <div class="text-[10px] text-brand-700 font-semibold">Vous</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="text-sm">{{ $user->email }}</td>
                <td>
                    @if($user->role === 'super_admin')
                        <span class="badge-success">Super Admin</span>
                    @elseif($user->role === 'admin')
                        <span class="badge-info">Admin</span>
                    @else
                        <span class="badge-gray">Gestionnaire</span>
                    @endif
                </td>
                <td class="text-xs text-slate-500">
                    {{ $user->created_at?->format('d/m/Y') }}
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <button type="button" onclick="openShowModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">visibility</span>
                        </button>
                        <button type="button" onclick="openEditModal({{ $user->id }})" class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-brand-50 hover:text-brand-700">
                            <span class="material-symbols-rounded text-lg">edit</span>
                        </button>
                        @if(auth('admin')->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce compte ?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-md flex items-center justify-center text-slate-500 hover:bg-red-50 hover:text-red-600">
                                    <span class="material-symbols-rounded text-lg">delete</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-16 text-slate-400">Aucun utilisateur trouvé</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-4 py-3 border-t border-slate-200 flex justify-between items-center text-xs text-slate-500">
        <span>Total : {{ $users->total() ?? 0 }} utilisateurs</span>
        <div>{{ $users->links() }}</div>
    </div>
</div>

{{-- ========== MODAL CREATE ========== --}}
<div id="createModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeCreateModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">person_add</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Nouveau compte admin</h2>
                    <p class="text-xs text-slate-500">Créer un nouvel utilisateur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="createForm" method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col flex-1 min-h-0">
            @csrf
            <div id="createFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeCreateModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL EDIT ========== --}}
<div id="editModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeEditModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">edit</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Modifier le compte</h2>
                    <p class="text-xs text-slate-500">Mettre à jour les informations</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <form id="editForm" method="POST" class="flex flex-col flex-1 min-h-0">
            @csrf
            @method('PUT')
            <div id="editFormContent" class="flex-1 overflow-y-auto px-6 py-5">
                <div class="text-center py-12 text-slate-400">Chargement...</div>
            </div>
            <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-2 bg-slate-50 rounded-b-xl">
                <button type="button" onclick="closeEditModal()" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-primary">
                    <span class="material-symbols-rounded text-lg">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ========== MODAL SHOW ========== --}}
<div id="showModal" class="fixed inset-0 z-[9999] items-center justify-center p-4" style="display:none;">
    <div class="absolute inset-0 bg-black/50" onclick="closeShowModal()"></div>
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-brand-700 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-xl">visibility</span>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-900">Détail utilisateur</h2>
                    <p class="text-xs text-slate-500">Informations complètes</p>
                </div>
            </div>
            <button type="button" onclick="closeShowModal()" class="w-9 h-9 rounded-md flex items-center justify-center text-slate-500 hover:bg-slate-100">
                <span class="material-symbols-rounded">close</span>
            </button>
        </div>
        <div id="showContent" class="flex-1 overflow-y-auto px-6 py-5">
            <div class="text-center py-12 text-slate-400">Chargement...</div>
        </div>
    </div>
</div>

<script>
    console.log('✅ Script users chargé');

    // ========== CREATE ==========
    function openCreateModal() {
        console.log('🔵 CREATE');
        const modal = document.getElementById('createModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch('{{ route("admin.users.create") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('createFormContent').innerHTML = data.html;
            console.log('📦 CREATE chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('createFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== EDIT ==========
    function openEditModal(id) {
        console.log('🔵 EDIT', id);
        const modal = document.getElementById('editModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        const form = document.getElementById('editForm');
        form.action = `/admin/users/${id}`;

        fetch(`/admin/users/${id}/edit`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('editFormContent').innerHTML = data.html;
            console.log('📦 EDIT chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('editFormContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SHOW ==========
    function openShowModal(id) {
        console.log('🔵 SHOW', id);
        const modal = document.getElementById('showModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';

        fetch(`/admin/users/${id}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('showContent').innerHTML = data.html;
            console.log('📦 SHOW chargé');
        })
        .catch(err => {
            console.error(err);
            document.getElementById('showContent').innerHTML =
                '<div class="text-center py-12 text-red-500">Erreur</div>';
        });
    }

    function closeShowModal() {
        document.getElementById('showModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ========== SOUMISSION AJAX ==========
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.id !== 'createForm' && form.id !== 'editForm') return;

        e.preventDefault();
        console.log('📤 Soumission AJAX', form.id);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="material-symbols-rounded text-lg animate-spin">progress_activity</span> Enregistrement...';

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: new FormData(form),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                console.log('✅ Succès');
                window.location.href = data.redirect || window.location.href;
            } else {
                alert(data.message || 'Erreur');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        })
        .catch(err => {
            console.error('❌', err);
            alert('Erreur : ' + err.message);
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // ========== ESCAPE ==========
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCreateModal(); closeEditModal(); closeShowModal();
        }
    });

    // ========== EXPOSER LES FONCTIONS ==========
    window.openCreateModal = openCreateModal;
    window.closeCreateModal = closeCreateModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.openShowModal = openShowModal;
    window.closeShowModal = closeShowModal;
</script>

@endsection
```

## resources/views/admin/users/partials/form.blade.php

```blade
<div class="space-y-5">

    {{-- Identité --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">person</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Identité</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Nom <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ old('nom', $user->nom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('nom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Prénom <span class="text-red-600">*</span></label>
                <input type="text" name="prenom" value="{{ old('prenom', $user->prenom ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('prenom') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Compte --}}
    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-2 pb-3 mb-4 border-b-2 border-slate-200">
            <span class="material-symbols-rounded text-brand-700 text-lg">mail</span>
            <h3 class="text-sm font-bold text-brand-700 uppercase tracking-wide">Compte</h3>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       required>
                @error('email') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">
                    Mot de passe {{ isset($user) ? '(laisser vide pour ne pas changer)' : '*' }}
                </label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100"
                       {{ isset($user) ? '' : 'required' }}>
                @error('password') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-1.5">Rôle <span class="text-red-600">*</span></label>
                <select name="role" class="w-full px-4 py-3 text-base border-2 border-slate-300 rounded-md focus:outline-none focus:border-brand-700 focus:ring-4 focus:ring-brand-100" required>
                    <option value="admin" @selected(old('role', $user->role ?? 'admin') === 'admin')>Admin</option>
                    <option value="gestionnaire" @selected(old('role', $user->role ?? '') === 'gestionnaire')>Gestionnaire</option>
                    <option value="super_admin" @selected(old('role', $user->role ?? '') === 'super_admin')>Super Admin</option>
                </select>
                @error('role') <p class="text-sm text-red-600 mt-1.5">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

</div>
```

## resources/views/admin/users/partials/show.blade.php

```blade
<div class="space-y-4">

    <div class="bg-white border-2 border-slate-300 rounded-lg p-5">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-brand-700 flex items-center justify-center text-white font-bold text-2xl">
                {{ strtoupper(substr($user->prenom ?? 'A', 0, 1) . substr($user->nom ?? 'D', 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-lg text-slate-900">{{ $user->prenom }} {{ $user->nom }}</div>
                <div class="text-sm text-slate-500">{{ $user->email }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Rôle</div>
            @if($user->role === 'super_admin')
                <span class="badge-success">Super Admin</span>
            @elseif($user->role === 'admin')
                <span class="badge-info">Admin</span>
            @else
                <span class="badge-gray">Gestionnaire</span>
            @endif
        </div>

        <div class="bg-white border-2 border-slate-300 rounded-lg p-4">
            <div class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">Créé le</div>
            <div class="font-semibold text-slate-900">{{ $user->created_at?->format('d/m/Y à H:i') }}</div>
        </div>
    </div>

</div>
```

## resources/views/admin/users/show.blade.php

```blade
@extends('layouts.admin')
@section('title', 'Détails de l\'utilisateur')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Détails de l'utilisateur</h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Nom complet</p>
            <p class="font-semibold text-slate-900">{{ $user->prenom }} {{ $user->nom }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Email</p>
            <p class="font-semibold text-slate-900">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Rôle</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-primary-50 text-primary-700">{{ $user->role }}</span>
        </div>
    </div>
</div>

<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
    <span class="material-symbols-rounded text-[18px]">edit</span>Modifier
</a>
@endsection
```

## resources/views/auth/admin/forgot-password.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Mot de passe oublié')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6
            bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-10 animate-fade-up">

        <a href="{{ route('admin.login') }}"
           class="inline-flex items-center gap-1 text-[13px] text-slate-500
                  hover:text-brand-700 transition mb-6">
            <span class="material-symbols-rounded text-[18px]">arrow_back</span>
            Retour
        </a>

        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700
                        flex items-center justify-center shadow-lg mb-5">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">lock_reset</span>
            </div>
            <h1 class="font-display text-2xl font-bold text-slate-900 text-center">
                Mot de passe oublié
            </h1>
            <p class="text-sm text-slate-500 text-center mt-1.5">
                Recevez un lien de réinitialisation par email
            </p>
        </div>

        @if (session('status'))
            <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                        bg-brand-50 border border-brand-200 text-brand-800 text-sm">
                <span class="material-symbols-rounded text-[20px] shrink-0">check_circle</span>
                <div>{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                        bg-red-50 border border-red-200 text-red-800 text-sm">
                <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="admin@sgformateurs.mg" required autofocus
                       class="form-input">
            </div>

            <button type="submit" class="w-full btn-primary justify-center py-3">
                Envoyer le lien
                <span class="material-symbols-rounded text-[18px]">send</span>
            </button>
        </form>

    </div>
</div>
@endsection
```

## resources/views/auth/admin/login.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Connexion Administrateur')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- ========== COLONNE GAUCHE : VISUEL VERT ========== --}}
    <div class="relative hidden lg:flex flex-col justify-between
                bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900
                p-12 text-white overflow-hidden">

        <div class="absolute inset-0 opacity-30"
             style="background-image:
                    radial-gradient(circle at 20% 30%, rgba(52,211,153,0.4) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(16,185,129,0.3) 0%, transparent 50%);"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur
                            flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-3xl"
                          style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <div>
                    <div class="font-display font-bold text-xl">SGFORMATEURS</div>
                    <div class="text-xs text-emerald-200/80">
                        Système de Gestion des Formateurs
                    </div>
                </div>
            </div>

            <div class="max-w-md">
                <p class="text-2xl font-display font-semibold leading-relaxed">
                    Un outil au service du METFP
                </p>
                <p class="text-emerald-200/80 mt-4 text-sm">
                    Ministère de l'Enseignement Technique
                    et de la Formation Professionnelle
                </p>
            </div>
        </div>

        <div class="relative z-10">
            <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800"
                 alt="Établissement"
                 class="rounded-2xl w-full h-64 object-cover shadow-2xl">
        </div>

        <div class="relative z-10 text-xs text-emerald-200/60">
            © {{ date('Y') }} SGFORMATEURS — Tous droits réservés
        </div>
    </div>

    {{-- ========== COLONNE DROITE : FORMULAIRE ========== --}}
    <div class="flex items-center justify-center p-6 lg:p-12 bg-white">
        <div class="w-full max-w-md animate-fade-up">

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1 text-[13px] text-slate-500
                      hover:text-brand-700 transition mb-6">
                <span class="material-symbols-rounded text-[18px]">arrow_back</span>
                Retour à l'accueil
            </a>

            <h1 class="font-display text-3xl font-bold text-slate-900">Connexion</h1>
            <p class="text-sm text-slate-500 mt-1">Accédez à votre espace</p>

            {{-- Onglets --}}
            <div class="grid grid-cols-2 gap-2 mt-6 mb-6">
                <a href="{{ route('admin.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-brand-600 text-white shadow-sm">
                    Administrateur
                </a>
                <a href="{{ route('formateur.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    Formateur
                </a>
            </div>

            {{-- Erreurs --}}
            @if ($errors->any())
                <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                            bg-red-50 border border-red-200 text-red-800 text-sm">
                    <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label">Email ou matricule</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2
                                     material-symbols-rounded text-slate-400 text-xl
                                     pointer-events-none">mail</span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="Entrez votre email ou matricule"
                               required autofocus
                               class="form-input pl-11">
                    </div>
                </div>

                <div>
                    <label class="form-label">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2
                                     material-symbols-rounded text-slate-400 text-xl
                                     pointer-events-none">lock</span>
                        <input type="password" name="password" id="password"
                               placeholder="Entrez votre mot de passe" required
                               class="form-input pl-11 pr-12">
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2
                                       text-slate-400 hover:text-brand-700 transition p-1">
                            <span class="material-symbols-rounded text-xl" id="toggleIcon">
                                visibility
                            </span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 text-[13px] text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-slate-300 text-brand-600
                                      focus:ring-brand-500">
                        Se souvenir de moi
                    </label>
                    <a href="{{ route('admin.password.request') }}"
                       class="text-[13px] font-semibold text-brand-700
                              hover:text-brand-500 transition">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit"
                        class="w-full btn-primary justify-center py-3">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-6">
                Vous n'avez pas de compte ?
                <a href="{{ route('admin.register') }}"
                   class="font-semibold text-brand-700 hover:underline">
                    Contacter l'administration
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endsection
```

## resources/views/auth/admin/register.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Inscription Administrateur')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <div class="relative hidden lg:flex flex-col justify-between
                bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900
                p-12 text-white">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div>
                <div class="font-display font-bold text-xl">SGFORMATEURS</div>
                <div class="text-xs text-emerald-200/80">Créer un compte</div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800"
             alt="Établissement"
             class="rounded-2xl w-full h-64 object-cover shadow-2xl">
        <p class="text-xs text-emerald-200/60">
            © {{ date('Y') }} SGFORMATEURS
        </p>
    </div>

    <div class="flex items-center justify-center p-6 lg:p-12 bg-white">
        <div class="w-full max-w-md animate-fade-up">

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1 text-[13px] text-slate-500
                      hover:text-brand-700 transition mb-6">
                <span class="material-symbols-rounded text-[18px]">arrow_back</span>
                Retour
            </a>

            <h1 class="font-display text-3xl font-bold text-slate-900">Inscription</h1>
            <p class="text-sm text-slate-500 mt-1">Créez votre compte administrateur</p>

            <div class="grid grid-cols-2 gap-2 mt-6 mb-6">
                <a href="{{ route('admin.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    Connexion
                </a>
                <a href="{{ route('admin.register') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-brand-600 text-white shadow-sm">
                    Inscription
                </a>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                            bg-red-50 border border-red-200 text-red-800 text-sm">
                    <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                    <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
                </div>
            @endif

            <form action="{{ route('admin.register') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nom" value="{{ old('nom') }}"
                               placeholder="Nom" required class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}"
                               placeholder="Prénom" required class="form-input">
                    </div>
                </div>

                <div>
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@sgformateurs.mg" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password"
                           placeholder="Min 8 caractères" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Confirmation *</label>
                    <input type="password" name="password_confirmation"
                           placeholder="Confirmer" required class="form-input">
                </div>

                <button type="submit" class="w-full btn-primary justify-center py-3">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-6">
                Déjà un compte ?
                <a href="{{ route('admin.login') }}"
                   class="font-semibold text-brand-700 hover:underline">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
```

## resources/views/auth/admin/reset-password.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6
            bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-10 animate-fade-up">

        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700
                        flex items-center justify-center shadow-lg mb-5">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">key</span>
            </div>
            <h1 class="font-display text-2xl font-bold text-slate-900 text-center">
                Nouveau mot de passe
            </h1>
            <p class="text-sm text-slate-500 text-center mt-1.5">
                Choisissez un nouveau mot de passe sécurisé
            </p>
        </div>

        @if ($errors->any())
            <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                        bg-red-50 border border-red-200 text-red-800 text-sm">
                <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
        @endif

        <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token ?? '' }}">

            <div>
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" value="{{ old('email', $email ?? '') }}"
                       required readonly class="form-input bg-slate-100">
            </div>

            <div>
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" name="password" placeholder="••••••••"
                       required class="form-input">
            </div>

            <div>
                <label class="form-label">Confirmation</label>
                <input type="password" name="password_confirmation"
                       placeholder="••••••••" required class="form-input">
            </div>

            <button type="submit" class="w-full btn-primary justify-center py-3">
                Réinitialiser
                <span class="material-symbols-rounded text-[18px]">check</span>
            </button>
        </form>
    </div>
</div>
@endsection
```

## resources/views/auth/admin/verify-email.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Vérification Email')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl ring-1 ring-white/20 p-10 animate-fade-up text-center">

    <div class="flex justify-center mb-6">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-primary-lg">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">mark_email_unread</span>
        </div>
    </div>

    <h1 class="font-display text-[26px] font-bold text-slate-900">Vérifiez votre email</h1>
    <p class="text-sm text-slate-500 mt-2">Nous vous avons envoyé un lien de vérification. Vérifiez votre boîte de réception.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 px-4 py-3 rounded-xl bg-primary-50 border border-primary-200 text-primary-800 text-sm">
            Un nouveau lien a été envoyé !
        </div>
    @endif

    <form action="{{ route('admin.verification.send') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-primary-500 to-primary-700 text-white font-semibold text-sm shadow-primary hover:-translate-y-0.5 transition-all">
            Renvoyer l'email <span class="material-symbols-rounded text-[18px]">refresh</span>
        </button>
    </form>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="text-sm text-slate-500 hover:text-primary-700 transition">Se déconnecter</button>
    </form>
</div>
@endsection
```

## resources/views/auth/formateur/forgot-password.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Mot de passe oublié')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_25px_60px_rgba(15,118,110,0.20)] ring-1 ring-emerald-100 p-10 animate-fade-up lg:ml-[5%] lg:mt-4 xl:ml-[7%]">

    <a href="{{ route('formateur.login') }}" class="inline-flex items-center gap-1 text-[13px] text-slate-500 hover:text-emerald-700 transition mb-6">
        <span class="material-symbols-rounded text-[18px]">arrow_back</span>Retour
    </a>

    <div class="flex flex-col items-center mb-8">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 flex items-center justify-center shadow-[0_16px_30px_rgba(13,148,136,0.35)] mb-5">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">lock_reset</span>
        </div>
        <h1 class="font-display text-[26px] font-bold text-slate-900 text-center">
            <span class="bg-linear-to-br from-emerald-600 to-teal-700 bg-clip-text text-transparent">Mot de passe</span> oublié
        </h1>
        <p class="text-sm text-slate-500 text-center mt-1.5">Recevez un lien de réinitialisation par email</p>
    </div>

    @if (session('status'))
        <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm mb-5">
            <span class="material-symbols-rounded text-[20px] shrink-0">check_circle</span>
            <div>{{ session('status') }}</div>
        </div>
    @endif
    @if ($errors->any())
        <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm mb-5">
            <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
            <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        </div>
    @endif

    <form action="{{ route('formateur.password.email') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-[13px] font-semibold text-slate-700 mb-2">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="votre.email@exemple.com" required autofocus
                   class="w-full px-4 py-3.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-50 text-sm outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100">
        </div>
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white font-semibold text-sm shadow-[0_12px_25px_rgba(16,185,129,0.28)] hover:-translate-y-0.5 transition-all">
            Envoyer le lien <span class="material-symbols-rounded text-[18px]">send</span>
        </button>
    </form>
</div>
@endsection
```

## resources/views/auth/formateur/login.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Connexion Formateur')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <div class="relative hidden lg:flex flex-col justify-between
                bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900
                p-12 text-white overflow-hidden">

        <div class="absolute inset-0 opacity-30"
             style="background-image:
                    radial-gradient(circle at 20% 30%, rgba(52,211,153,0.4) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(16,185,129,0.3) 0%, transparent 50%);"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center">
                    <span class="material-symbols-rounded text-white text-3xl"
                          style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <div>
                    <div class="font-display font-bold text-xl">SGFORMATEURS</div>
                    <div class="text-xs text-emerald-200/80">Espace Formateur</div>
                </div>
            </div>

            <p class="text-2xl font-display font-semibold leading-relaxed max-w-md">
                Gérez vos formations, sessions et présences en toute simplicité
            </p>
        </div>

        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800"
             alt="Formation"
             class="relative z-10 rounded-2xl w-full h-64 object-cover shadow-2xl">

        <div class="relative z-10 text-xs text-emerald-200/60">
            © {{ date('Y') }} SGFORMATEURS
        </div>
    </div>

    <div class="flex items-center justify-center p-6 lg:p-12 bg-white">
        <div class="w-full max-w-md animate-fade-up">

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1 text-[13px] text-slate-500
                      hover:text-brand-700 transition mb-6">
                <span class="material-symbols-rounded text-[18px]">arrow_back</span>
                Retour à l'accueil
            </a>

            <h1 class="font-display text-3xl font-bold text-slate-900">Connexion</h1>
            <p class="text-sm text-slate-500 mt-1">Accédez à votre espace formateur</p>

            <div class="grid grid-cols-2 gap-2 mt-6 mb-6">
                <a href="{{ route('admin.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    Administrateur
                </a>
                <a href="{{ route('formateur.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-brand-600 text-white shadow-sm">
                    Formateur
                </a>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                            bg-red-50 border border-red-200 text-red-800 text-sm">
                    <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                    <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
                </div>
            @endif

            <form action="{{ route('formateur.login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="form-label">Adresse email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2
                                     material-symbols-rounded text-slate-400 text-xl
                                     pointer-events-none">mail</span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="votre.email@exemple.com"
                               required autofocus class="form-input pl-11">
                    </div>
                </div>

                <div>
                    <label class="form-label">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2
                                     material-symbols-rounded text-slate-400 text-xl
                                     pointer-events-none">lock</span>
                        <input type="password" name="password" id="password"
                               placeholder="••••••••" required
                               class="form-input pl-11 pr-12">
                        <button type="button" onclick="togglePassword()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2
                                       text-slate-400 hover:text-brand-700 transition p-1">
                            <span class="material-symbols-rounded text-xl" id="toggleIcon">
                                visibility
                            </span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 text-[13px] text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-slate-300 text-brand-600
                                      focus:ring-brand-500">
                        Se souvenir de moi
                    </label>
                    <a href="{{ route('formateur.password.request') }}"
                       class="text-[13px] font-semibold text-brand-700 hover:text-brand-500">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit" class="w-full btn-primary justify-center py-3">
                    Se connecter
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-6">
                Vous n'avez pas de compte ?
                <a href="{{ route('formateur.register') }}"
                   class="font-semibold text-brand-700 hover:underline">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') { input.type = 'text'; icon.textContent = 'visibility_off'; }
        else { input.type = 'password'; icon.textContent = 'visibility'; }
    }
</script>
@endsection
```

## resources/views/auth/formateur/register.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Inscription Formateur')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <div class="relative hidden lg:flex flex-col justify-between
                bg-gradient-to-br from-brand-700 via-brand-800 to-brand-900
                p-12 text-white">
        <div class="flex items-center gap-3">
            <div class="w-14 h-14 rounded-2xl bg-white/15 flex items-center justify-center">
                <span class="material-symbols-rounded text-white text-3xl"
                      style="font-variation-settings: 'FILL' 1;">school</span>
            </div>
            <div>
                <div class="font-display font-bold text-xl">SGFORMATEURS</div>
                <div class="text-xs text-emerald-200/80">Inscription formateur</div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800"
             alt="Formation"
             class="rounded-2xl w-full h-64 object-cover shadow-2xl">
        <p class="text-xs text-emerald-200/60">© {{ date('Y') }} SGFORMATEURS</p>
    </div>

    <div class="flex items-center justify-center p-6 lg:p-12 bg-white">
        <div class="w-full max-w-md animate-fade-up">

            <a href="{{ route('home') }}"
               class="inline-flex items-center gap-1 text-[13px] text-slate-500
                      hover:text-brand-700 transition mb-6">
                <span class="material-symbols-rounded text-[18px]">arrow_back</span>
                Retour
            </a>

            <h1 class="font-display text-3xl font-bold text-slate-900">Inscription</h1>
            <p class="text-sm text-slate-500 mt-1">Créez votre compte formateur</p>

            <div class="grid grid-cols-2 gap-2 mt-6 mb-6">
                <a href="{{ route('formateur.login') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    Connexion
                </a>
                <a href="{{ route('formateur.register') }}"
                   class="flex items-center justify-center gap-1.5 px-3 py-2.5
                          rounded-lg text-[13px] font-semibold
                          bg-brand-600 text-white shadow-sm">
                    Inscription
                </a>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-lg mb-5
                            bg-red-50 border border-red-200 text-red-800 text-sm">
                    <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
                    <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
                </div>
            @endif

            <form action="{{ route('formateur.register') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nom" value="{{ old('nom') }}"
                               placeholder="Nom" required class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}"
                               placeholder="Prénom" required class="form-input">
                    </div>
                </div>

                <div>
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="votre.email@exemple.com" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}"
                           placeholder="+261 34 00 000 00" class="form-input">
                </div>

                <div>
                    <label class="form-label">Matricule *</label>
                    <input type="text" name="matricule" value="{{ old('matricule') }}"
                           placeholder="FORM-001" required
                           class="form-input font-mono uppercase">
                    <p class="text-xs text-slate-400 mt-1">Format : FORM-XXX</p>
                </div>

                <div>
                    <label class="form-label">Mot de passe *</label>
                    <input type="password" name="password"
                           placeholder="Min 8 caractères" required class="form-input">
                </div>

                <div>
                    <label class="form-label">Confirmation *</label>
                    <input type="password" name="password_confirmation"
                           placeholder="Confirmer" required class="form-input">
                </div>

                <button type="submit" class="w-full btn-primary justify-center py-3">
                    Créer mon compte
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
```

## resources/views/auth/formateur/reset-password.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Réinitialiser le mot de passe')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_25px_60px_rgba(15,118,110,0.20)] ring-1 ring-emerald-100 p-10 animate-fade-up lg:ml-[5%] xl:ml-[7%]">

    <div class="flex flex-col items-center mb-8">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 flex items-center justify-center shadow-[0_16px_30px_rgba(13,148,136,0.35)] mb-5">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">key</span>
        </div>
        <h1 class="font-display text-[26px] font-bold text-slate-900 text-center">Nouveau mot de passe</h1>
        <p class="text-sm text-slate-500 text-center mt-1.5">Choisissez un nouveau mot de passe</p>
    </div>

    @if ($errors->any())
        <div class="flex items-start gap-2.5 px-4 py-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm mb-5">
            <span class="material-symbols-rounded text-[20px] shrink-0">error</span>
            <div>@foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
        </div>
    @endif

    <form action="{{ route('formateur.password.update') }}" method="POST" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $token ?? '' }}">
        <div>
            <label class="block text-[13px] font-semibold text-slate-700 mb-2">Adresse email</label>
            <input type="email" name="email" value="{{ old('email', $email ?? '') }}" required readonly
                   class="w-full px-4 py-3.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-100 text-sm outline-none">
        </div>
        <div>
            <label class="block text-[13px] font-semibold text-slate-700 mb-2">Nouveau mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required
                   class="w-full px-4 py-3.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-50 text-sm outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-50">
        </div>
        <div>
            <label class="block text-[13px] font-semibold text-slate-700 mb-2">Confirmation</label>
            <input type="password" name="password_confirmation" placeholder="••••••••" required
                   class="w-full px-4 py-3.5 rounded-xl border-[1.5px] border-slate-200 bg-slate-50 text-sm outline-none transition-all focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-50">
        </div>
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white font-semibold text-sm shadow-[0_12px_25px_rgba(16,185,129,0.28)] hover:-translate-y-0.5 transition-all">
            Réinitialiser <span class="material-symbols-rounded text-[18px]">check</span>
        </button>
    </form>
</div>
@endsection
```

## resources/views/auth/formateur/verify-email.blade.php

```blade
@extends('layouts.guest')
@section('title', 'Vérification Email')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_25px_60px_rgba(15,118,110,0.20)] ring-1 ring-emerald-100 p-10 animate-fade-up text-center lg:ml-[5%] xl:ml-[7%]">

    <div class="flex justify-center mb-6">
        <div class="w-[72px] h-[72px] rounded-2xl bg-linear-to-br from-emerald-600 to-teal-700 flex items-center justify-center shadow-[0_16px_30px_rgba(13,148,136,0.35)]">
            <span class="material-symbols-rounded text-white text-[40px]" style="font-variation-settings: 'FILL' 1;">mark_email_unread</span>
        </div>
    </div>

    <h1 class="font-display text-[26px] font-bold text-slate-900">Vérifiez votre email</h1>
    <p class="text-sm text-slate-500 mt-2">Nous vous avons envoyé un lien de vérification. Vérifiez votre boîte de réception.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
            Un nouveau lien a été envoyé !
        </div>
    @endif

    <form action="{{ route('formateur.verification.send') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-linear-to-br from-emerald-600 to-teal-700 text-white font-semibold text-sm shadow-[0_12px_25px_rgba(16,185,129,0.28)] hover:-translate-y-0.5 transition-all">
            Renvoyer l'email <span class="material-symbols-rounded text-[18px]">refresh</span>
        </button>
    </form>

    <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="text-sm text-slate-500 hover:text-emerald-700 transition">Se déconnecter</button>
    </form>
</div>
@endsection
```

## resources/views/emails/reset-password.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation de mot de passe</title>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; background: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 101, 44, 0.1);">
        <div style="background: linear-gradient(135deg, #059669, #047857); padding: 40px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 28px;">SGFORMATEURS</h1>
            <p style="color: rgba(255,255,255,0.9); margin-top: 8px;">Réinitialisation de mot de passe</p>
        </div>
        <div style="padding: 40px;">
            <h2 style="color: #1e293b; margin-top: 0;">Bonjour,</h2>
            <p style="color: #64748b; line-height: 1.6;">Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>
            <div style="text-align: center; margin: 32px 0;">
                <a href="{{ $url }}" style="display: inline-block; background: linear-gradient(135deg, #059669, #047857); color: white; padding: 14px 32px; border-radius: 12px; text-decoration: none; font-weight: 600;">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            <p style="color: #64748b; line-height: 1.6; font-size: 14px;">Ce lien expirera dans 60 minutes.</p>
            <p style="color: #94a3b8; font-size: 12px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0;">Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.</p>
        </div>
        <div style="background: #f8fafc; padding: 20px; text-align: center;">
            <p style="color: #94a3b8; font-size: 12px; margin: 0;">© {{ date('Y') }} SGFORMATEURS - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
```

## resources/views/emails/verify-email.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification d'email</title>
</head>
<body style="font-family: 'Inter', Arial, sans-serif; background: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 101, 44, 0.1);">
        <div style="background: linear-gradient(135deg, #059669, #047857); padding: 40px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 28px;">SGFORMATEURS</h1>
            <p style="color: rgba(255,255,255,0.9); margin-top: 8px;">Vérification de votre email</p>
        </div>
        <div style="padding: 40px;">
            <h2 style="color: #1e293b; margin-top: 0;">Bienvenue !</h2>
            <p style="color: #64748b; line-height: 1.6;">Merci de vous être inscrit sur SGFORMATEURS. Veuillez confirmer votre adresse email en cliquant sur le bouton ci-dessous.</p>
            <div style="text-align: center; margin: 32px 0;">
                <a href="{{ $url }}" style="display: inline-block; background: linear-gradient(135deg, #059669, #047857); color: white; padding: 14px 32px; border-radius: 12px; text-decoration: none; font-weight: 600;">
                    Vérifier mon email
                </a>
            </div>
            <p style="color: #94a3b8; font-size: 12px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0;">Si vous n'avez pas créé de compte, veuillez ignorer cet email.</p>
        </div>
        <div style="background: #f8fafc; padding: 20px; text-align: center;">
            <p style="color: #94a3b8; font-size: 12px; margin: 0;">© {{ date('Y') }} SGFORMATEURS - Tous droits réservés</p>
        </div>
    </div>
</body>
</html>
```

## resources/views/errors/401.blade.php

```blade
@extends('errors.layout')
@section('code', '401')
@section('titre', 'Non authentifié')
@section('message', 'Vous devez vous connecter pour accéder à cette ressource.')
```

## resources/views/errors/403.blade.php

```blade
@extends('errors.layout')
@section('code', '403')
@section('titre', 'Accès refusé')
@section('message', "Vous n'avez pas les droits nécessaires pour consulter cette page. Contactez l'administration si vous pensez qu'il s'agit d'une erreur.")
```

## resources/views/errors/404.blade.php

```blade
@extends('errors.layout')
@section('code', '404')
@section('titre', 'Page non trouvée')
@section('message', "La page que vous recherchez n'existe pas ou a été déplacée. Vérifiez l'adresse saisie ou revenez à l'accueil.")
```

## resources/views/errors/419.blade.php

```blade
@extends('errors.layout')
@section('code', '419')
@section('titre', 'Session expirée')
@section('message', 'Votre session a expiré pour des raisons de sécurité. Veuillez vous reconnecter pour continuer.')
```

## resources/views/errors/429.blade.php

```blade
@extends('errors.layout')
@section('code', '429')
@section('titre', 'Trop de requêtes')
@section('message', 'Vous avez effectué trop de requêtes en peu de temps. Patientez un instant avant de réessayer.')
```

## resources/views/errors/500.blade.php

```blade
@extends('errors.layout')
@section('code', '500')
@section('titre', 'Erreur interne du serveur')
@section('message', "Une erreur inattendue s'est produite de notre côté. L'équipe technique a été informée.")
```

## resources/views/errors/503.blade.php

```blade
@extends('errors.layout')
@section('code', '503')
@section('titre', 'Service indisponible')
@section('message', "L'application est temporairement en maintenance. Merci de revenir dans quelques instants.")
```

## resources/views/errors/layout.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('code') — SGFORMATEURS</title>

    @vite(['resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
</head>
<body class="font-sans bg-slate-50 text-slate-900 antialiased">

<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 text-center">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-10">
        <div class="w-11 h-11 rounded-xl bg-brand-600 flex items-center justify-center">
            <span class="material-symbols-rounded text-white text-2xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="text-left leading-tight">
            <div class="font-display font-bold text-slate-900">SGFORMATEURS</div>
            <div class="text-[10px] text-slate-500">Système de Gestion des Formateurs</div>
        </div>
    </a>

    {{-- Illustration --}}
    <div class="relative mb-8">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-56 h-56 rounded-full bg-brand-100/60 blur-2xl"></div>
        </div>
        <div class="relative font-display font-extrabold text-[100px] sm:text-[140px]
                    leading-none bg-gradient-to-br from-brand-500 to-brand-800
                    bg-clip-text text-transparent animate-pulse-slow">
            @yield('code')
        </div>
    </div>

    <h1 class="font-display text-2xl sm:text-3xl font-bold text-slate-900">
        @yield('titre')
    </h1>
    <p class="text-sm text-slate-500 mt-3 max-w-md leading-relaxed">
        @yield('message')
    </p>

    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="{{ url('/') }}" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">home</span>
            Retour à l'accueil
        </a>
        <button onclick="history.back()" class="btn-secondary">
            <span class="material-symbols-rounded text-[18px]">arrow_back</span>
            Page précédente
        </button>
    </div>

    <p class="text-[11px] text-slate-400 mt-12">
        © {{ date('Y') }} SGFORMATEURS — Ministère de l'Enseignement Technique
        et de la Formation Professionnelle
    </p>
</div>

</body>
</html>
```

## resources/views/formateur/affectations/index.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Mes affectations')

@section('content')
<div class="mb-8">
    <h1 class="font-display text-3xl font-bold text-slate-900">Mes affectations</h1>
    <p class="text-sm text-slate-500 mt-1">Total : {{ $affectations->count() }} affectation(s)</p>
</div>

@if(!$formateurMetier)
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-800 text-sm">
        <span class="material-symbols-rounded">warning</span>
        <div>Votre profil formateur n'est pas encore configuré. Contactez l'administration.</div>
    </div>
@else

@php
    $actives = $affectations->where('statut', 'actif')->count();
    $terminees = $affectations->where('statut', 'termine')->count();
    $suspendues = $affectations->where('statut', 'suspendu')->count();
@endphp

<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-green-500">
        <div class="font-display text-3xl font-bold text-green-600">{{ $affectations->count() }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Total</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-emerald-500">
        <div class="font-display text-3xl font-bold text-emerald-600">{{ $actives }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Actives</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-slate-500">
        <div class="font-display text-3xl font-bold text-slate-600">{{ $terminees }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Terminées</div>
    </div>
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 border-l-4 border-green-500">
        <div class="font-display text-3xl font-bold text-green-600">{{ $suspendues }}</div>
        <div class="text-xs text-slate-500 uppercase tracking-wider mt-1">Suspendues</div>
    </div>
</div>

@if($affectations->count() === 0)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
        <span class="material-symbols-rounded text-6xl text-slate-300 block mb-3">inbox</span>
        <p class="text-slate-500 font-semibold">Aucune affectation pour le moment.</p>
    </div>
@else
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Filière</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Niveau</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Secteur</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Établissement</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Période</th>
                    <th class="text-left px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Statut</th>
                    <th class="text-right px-6 py-3.5 text-[11px] font-bold text-slate-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($affectations as $a)
                <tr class="border-b border-slate-100 hover:bg-emerald-50/40 transition last:border-0">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-900 text-sm">{{ $a->filiere?->libelle ?? '—' }}</div>
                        <div class="text-xs text-slate-500 font-mono">{{ $a->filiere?->code ?? '' }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->filiere?->niveau?->code ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->filiere?->secteur?->libelle ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-700">{{ $a->etablissement?->nom ?? '—' }}</td>
                    <td class="px-6 py-4 text-xs text-slate-700">
                        Du {{ $a->date_debut?->format('d/m/Y') ?? '—' }}<br>
                        Au {{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold
                            @if($a->statut === 'actif') bg-emerald-50 text-emerald-700
                            @elseif($a->statut === 'termine') bg-slate-100 text-slate-600
                            @else bg-green-50 text-green-700 @endif">
                            {{ ucfirst($a->statut) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('formateur.affectations.show', $a->id) }}" class="text-emerald-700 hover:text-emerald-500 font-semibold text-sm">
                            Détails →
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endif
@endsection
```

## resources/views/formateur/affectations/show.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Détails de l\'affectation')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('formateur.affectations.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Détails de l'affectation</h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Filière</p>
            <p class="font-semibold text-slate-900">{{ $affectation->filiere->libelle ?? '—' }}</p>
            <p class="text-xs text-slate-500 font-mono mt-1">{{ $affectation->filiere->code ?? '' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Établissement</p>
            <p class="font-semibold text-slate-900">{{ $affectation->etablissement->nom ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Niveau</p>
            <p class="font-semibold text-slate-900">{{ $affectation->filiere->niveau->libelle ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Secteur</p>
            <p class="font-semibold text-slate-900">{{ $affectation->filiere->secteur->libelle ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date début</p>
            <p class="font-semibold text-slate-900">{{ $affectation->date_debut?->format('d/m/Y') ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date fin</p>
            <p class="font-semibold text-slate-900">{{ $affectation->date_fin?->format('d/m/Y') ?? 'En cours' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Statut</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-primary-50 text-primary-700">
                {{ ucfirst($affectation->statut ?? 'actif') }}
            </span>
        </div>
    </div>
</div>

@if($affectation->filiere && $affectation->filiere->options && $affectation->filiere->options->count())
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
        <h3 class="font-display font-bold text-lg text-slate-900">Options de la filière</h3>
    </div>
    <div class="p-8 flex flex-wrap gap-2">
        @foreach($affectation->filiere->options as $option)
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[12px] font-semibold bg-green-50 text-green-700">{{ $option->libelle }}</span>
        @endforeach
    </div>
</div>
@endif
@endsection
```

## resources/views/formateur/dashboard/index.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Tableau de bord')

@section('content')

<div class="bg-linear-to-br from-emerald-600 via-teal-700 to-emerald-800 rounded-3xl p-10 text-white mb-8 relative overflow-hidden shadow-[0_20px_40px_rgba(13,148,136,0.22)]">
    <div class="absolute -top-12 -right-12 w-64 h-64 rounded-full" style="background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);"></div>
    <div class="absolute -bottom-20 right-24 w-52 h-52 rounded-full" style="background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);"></div>
    <div class="relative z-10">
        <div class="flex items-center gap-2 text-[13px] text-white/80 mb-3">
            <span class="material-symbols-rounded text-base">waving_hand</span>
            Bonjour
        </div>
        <h1 class="font-display text-3xl font-bold">{{ $formateur->prenom }} {{ $formateur->nom }}</h1>
        <p class="text-white/70 text-sm mt-2">Bienvenue dans votre espace formateur SGFORMATEURS</p>
        <div class="inline-flex items-center gap-2 mt-4 px-3 py-1.5 rounded-full bg-white/15 backdrop-blur-sm">
            <span class="material-symbols-rounded text-sm">badge</span>
            <span class="text-sm font-mono">{{ $formateur->matricule }}</span>
        </div>
    </div>
</div>

@php
    $formateurMetier = \Infrastructure\Persistence\Eloquent\Models\FormateurModel::where('matricule', $formateur->matricule)
        ->orWhere('email', $formateur->email)->first();
    $nbAffectations = $formateurMetier ? \Infrastructure\Persistence\Eloquent\Models\AffectationModel::where('formateur_id', $formateurMetier->id)->count() : 0;
    $nbSessions = $formateurMetier ? \Infrastructure\Persistence\Eloquent\Models\SessionModel::where('formateur_id', $formateurMetier->id)->count() : 0;
    $nbPresences = $formateurMetier ? \Infrastructure\Persistence\Eloquent\Models\PresenceModel::where('formateur_id', $formateurMetier->id)->count() : 0;
    $nbPresents = $formateurMetier ? \Infrastructure\Persistence\Eloquent\Models\PresenceModel::where('formateur_id', $formateurMetier->id)->where('statut', 'present')->count() : 0;
    $taux = $nbPresences > 0 ? round(($nbPresents / $nbPresences) * 100, 2) : 0;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 border-l-4 border-green-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-green-600 text-2xl">assignment_ind</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">{{ $nbAffectations }}</div>
        <div class="text-[13px] text-slate-500 mt-1">Affectations</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 border-l-4 border-green-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-green-600 text-2xl">event</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">{{ $nbSessions }}</div>
        <div class="text-[13px] text-slate-500 mt-1">Sessions</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 border-l-4 border-emerald-500">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-emerald-600 text-2xl">fact_check</span>
        </div>
        <div class="font-display text-3xl font-bold text-slate-900">{{ $nbPresences }}</div>
        <div class="text-[13px] text-slate-500 mt-1">Présences saisies</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 border-l-4 {{ $taux >= 80 ? 'border-emerald-500' : ($taux >= 60 ? 'border-green-500' : 'border-red-500') }}">
        <div class="flex items-center gap-3 mb-3">
            <span class="material-symbols-rounded text-2xl {{ $taux >= 80 ? 'text-emerald-600' : ($taux >= 60 ? 'text-green-600' : 'text-red-600') }}">trending_up</span>
        </div>
        <div class="font-display text-3xl font-bold {{ $taux >= 80 ? 'text-emerald-600' : ($taux >= 60 ? 'text-green-600' : 'text-red-600') }}">{{ $taux }}%</div>
        <div class="text-[13px] text-slate-500 mt-1">Taux de présence</div>
    </div>
</div>

<h2 class="font-display text-xl font-bold text-slate-900 mb-4">Actions rapides</h2>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <a href="{{ route('formateur.affectations.index') }}" class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all p-6 border-l-4 border-green-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center text-green-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded" style="font-variation-settings: 'FILL' 1;">assignment_ind</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mes affectations</h3>
        <p class="text-[13px] text-slate-500 mt-1">Consulter mes filières et établissements</p>
    </a>

    <a href="{{ route('formateur.sessions.index') }}" class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all p-6 border-l-4 border-green-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center text-green-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded" style="font-variation-settings: 'FILL' 1;">event</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mes sessions</h3>
        <p class="text-[13px] text-slate-500 mt-1">Voir les sessions de formation</p>
    </a>

    <a href="{{ route('formateur.presences.index') }}" class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-0.5 transition-all p-6 border-l-4 border-emerald-500 no-underline">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition">
                <span class="material-symbols-rounded" style="font-variation-settings: 'FILL' 1;">fact_check</span>
            </div>
        </div>
        <h3 class="font-display font-bold text-slate-900">Mes présences</h3>
        <p class="text-[13px] text-slate-500 mt-1">Saisir et consulter les présences</p>
    </a>
</div>

<h2 class="font-display text-xl font-bold text-slate-900 mb-4">Exports PDF</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <a href="{{ route('formateur.pdf.mes.presences') }}" target="_blank" class="group bg-linear-to-br from-red-500 to-red-700 text-white rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all no-underline">
        <div class="flex items-center gap-3 mb-2">
            <span class="material-symbols-rounded" style="font-variation-settings: 'FILL' 1;">picture_as_pdf</span>
        </div>
        <div class="font-display font-bold">Mes présences PDF</div>
        <div class="text-[13px] text-red-100 mt-1">Rapport du mois en cours</div>
    </a>

    <a href="{{ route('formateur.profile.edit') }}" class="group bg-linear-to-br from-slate-600 to-slate-800 text-white rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all no-underline">
        <div class="flex items-center gap-3 mb-2">
            <span class="material-symbols-rounded" style="font-variation-settings: 'FILL' 1;">settings</span>
        </div>
        <div class="font-display font-bold">Mon profil</div>
        <div class="text-[13px] text-slate-300 mt-1">Modifier mes informations</div>
    </a>
</div>

@endsection
```

## resources/views/formateur/profile/edit.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Mon profil')

@section('content')

<div class="mb-6">
    <h1 class="font-display text-2xl font-bold text-slate-900">Mon profil</h1>
    <p class="text-sm text-slate-500 mt-1">Gérez vos informations personnelles</p>
</div>

{{-- 🔒 STATUT EN LECTURE SEULE --}}
<div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="text-[11px] text-slate-500 uppercase font-semibold mb-1">
                Mon statut actuel
            </div>
            <div class="flex items-center gap-2">
                @if($formateur->statut === 'actif')
                    <span class="badge-success">Actif</span>
                @elseif($formateur->statut === 'suspendu')
                    <span class="badge-warning">Suspendu</span>
                @else
                    <span class="badge-danger">Inactif</span>
                @endif
            </div>
        </div>
        <div class="text-right">
            <div class="text-[11px] text-slate-500">
                Statut géré par l'administration
            </div>
            <div class="text-[10px] text-slate-400 mt-1">
                🔒 Non modifiable
            </div>
        </div>
    </div>
</div>

{{-- Formulaire de modification --}}
<form method="POST" action="{{ route('formateur.profile.update') }}"
      class="bg-white rounded-xl border border-slate-200 p-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
            <input type="text" name="nom" value="{{ old('nom', $formateur->nom) }}"
                   class="input-modern" required>
            @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Prénom *</label>
            <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom) }}"
                   class="input-modern" required>
            @error('prenom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email', $formateur->email) }}"
                   class="input-modern" required>
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input type="text" name="telephone" value="{{ old('telephone', $formateur->telephone) }}"
                   class="input-modern">
            @error('telephone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
            <textarea name="adresse" rows="2" class="input-modern">{{ old('adresse', $formateur->adresse) }}</textarea>
        </div>

    </div>

    <div class="flex items-center justify-end gap-2 mt-6 pt-6 border-t border-slate-200">
        <button type="submit" class="btn-primary">
            <span class="material-symbols-rounded text-[18px]">save</span>
            Enregistrer
        </button>
    </div>
</form>

@endsection
```

## resources/views/formateur/sessions/index.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Mes sessions')

@section('content')
<div class="mb-8">
    <h1 class="font-display text-3xl font-bold text-slate-900">Mes sessions</h1>
    <p class="text-sm text-slate-500 mt-1">Liste de vos sessions de formation</p>
</div>

@if(!$formateurMetier)
    <div class="flex items-start gap-3 px-5 py-4 rounded-2xl bg-green-50 border border-green-200 text-green-800 text-sm">
        <span class="material-symbols-rounded">warning</span>
        <div>Votre profil formateur n'est pas encore configuré.</div>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($sessions as $session)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all group">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-linear-to-br from-emerald-50 to-emerald-100 flex items-center justify-center text-emerald-600">
                        <span class="material-symbols-rounded text-2xl" style="font-variation-settings: 'FILL' 1;">event</span>
                    </div>
                    @if($session->estEnCours())
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700">En cours</span>
                    @elseif($session->estTerminee())
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">Terminée</span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-green-50 text-green-700">À venir</span>
                    @endif
                </div>
                <h3 class="font-display font-bold text-lg text-slate-900 font-mono">{{ $session->code }}</h3>
                <p class="text-sm text-slate-500 mt-1">{{ $session->filiere->libelle ?? '' }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $session->etablissement->nom ?? '' }}</p>
            </div>
            <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="material-symbols-rounded text-sm">calendar_today</span>
                    {{ $session->date_debut?->format('d/m/Y') ?? '—' }}
                </div>
                <a href="{{ route('formateur.sessions.show', $session->id) }}" class="text-emerald-700 hover:text-emerald-500 font-semibold text-sm">
                    Détails →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <span class="material-symbols-rounded text-6xl text-slate-300 block mb-2">event</span>
            <p class="text-slate-500">Aucune session assignée.</p>
        </div>
        @endforelse
    </div>
@endif
@endsection
```

## resources/views/formateur/sessions/show.blade.php

```blade
@extends('layouts.formateur')
@section('title', 'Détails de la session')

@section('content')
<div class="flex items-center gap-4 mb-8">
    <a href="{{ route('formateur.sessions.index') }}" class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary-700 transition">
        <span class="material-symbols-rounded">arrow_back</span>
    </a>
    <h1 class="font-display text-3xl font-bold text-slate-900">Détails de la session</h1>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-6">
    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Code</p>
            <p class="font-display font-bold text-xl text-slate-900 font-mono">{{ $session->code }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Filière</p>
            <p class="font-semibold text-slate-900">{{ $session->filiere->libelle ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Établissement</p>
            <p class="font-semibold text-slate-900">{{ $session->etablissement->nom ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date début</p>
            <p class="font-semibold text-slate-900">{{ $session->date_debut?->format('d/m/Y') ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Date fin</p>
            <p class="font-semibold text-slate-900">{{ $session->date_fin?->format('d/m/Y') ?? '—' }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Places</p>
            <p class="font-semibold text-slate-900">{{ $session->nb_places ?? 0 }}</p>
        </div>
    </div>
</div>

<a href="{{ route('formateur.pdf.presence.session', $session->id) }}" target="_blank" class="btn btn-primary">
    <span class="material-symbols-rounded text-[18px]">picture_as_pdf</span>Feuille de présence PDF
</a>
@endsection
```

## resources/views/layouts/admin.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SGFORMATEURS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
</head>
<body class="font-sans bg-slate-50 text-slate-900 antialiased">

@php
    $admin = Auth::guard('admin')->user();
    $initials = strtoupper(substr($admin->prenom ?? 'A', 0, 1) . substr($admin->nom ?? 'D', 0, 1));

    $menu = [
        // -------- ACCUEIL --------
        [
            'route' => 'admin.dashboard*',
            'url'   => 'admin.dashboard',
            'icon'  => 'home',
            'label' => 'Accueil',
        ],

        // -------- GESTION --------
        ['section' => 'Gestion'],
        [
            'route' => 'admin.formateurs.*',
            'url'   => 'admin.formateurs.index',
            'icon'  => 'groups',
            'label' => 'Formateurs',
        ],
        [
            'route' => 'admin.etablissements.*',
            'url'   => 'admin.etablissements.index',
            'icon'  => 'apartment',
            'label' => 'Établissements',
        ],
        [
            'route' => 'admin.filieres.*',
            'url'   => 'admin.filieres.index',
            'icon'  => 'school',
            'label' => 'Filières',
        ],
        [
            'route' => 'admin.affectations.*',
            'url'   => 'admin.affectations.index',
            'icon'  => 'assignment_ind',
            'label' => 'Affectations',
        ],
        [
            'route' => 'admin.sessions.*',
            'url'   => 'admin.sessions.index',
            'icon'  => 'event',
            'label' => 'Sessions',
        ],

        // -------- SYSTÈME --------
        ['section' => 'Système'],
        [
            'route' => 'admin.users.*',
            'url'   => 'admin.users.index',
            'icon'  => 'manage_accounts',
            'label' => 'Utilisateurs',
        ],
        [
            'route' => 'admin.pdf.*',
            'url'   => 'admin.pdf.index',
            'icon'  => 'description',
            'label' => 'Rapports',
        ],
    ];
@endphp

{{-- ============================================================
     SIDEBAR
     ============================================================ --}}
<aside id="sidebar"
       class="fixed top-0 left-0 h-screen w-64 bg-brand-900 flex flex-col z-50
              -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
            <span class="material-symbols-rounded text-white text-2xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="flex flex-col leading-tight">
            <span class="font-display font-bold text-white text-sm">SGFORMATEURS</span>
            <span class="text-[10px] text-emerald-200/70">Gestion des Formateurs</span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
        @foreach($menu as $item)
            @if(isset($item['section']))
                <div class="text-[10px] font-bold text-emerald-200/50 uppercase tracking-widest
                            px-3 pt-4 pb-2">
                    {{ $item['section'] }}
                </div>
            @else
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['url']) }}"
                   class="{{ $active ? 'sidebar-item-active' : 'sidebar-item-inactive' }}">
                    <span class="material-symbols-rounded text-[20px] shrink-0">
                        {{ $item['icon'] }}
                    </span>
                    <span class="flex-1">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <div class="p-3 border-t border-white/10">
        <div class="flex items-center gap-3 p-2.5 rounded-lg bg-white/5">
            <div class="avatar avatar-sm bg-gradient-to-br from-brand-400 to-brand-600">
                {{ $initials }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold text-[12px] text-white truncate">
                    {{ $admin->prenom }} {{ $admin->nom }}
                </div>
                <div class="text-[10px] text-emerald-200/70">Administrateur</div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="w-8 h-8 rounded-lg flex items-center justify-center
                               text-emerald-200/70 hover:bg-white/10 hover:text-white transition">
                    <span class="material-symbols-rounded text-[18px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"
     onclick="closeSidebar()"></div>

{{-- ============================================================
     CONTENU PRINCIPAL
     ============================================================ --}}
<div class="lg:ml-64 min-h-screen flex flex-col">

    <header class="sticky top-0 h-16 bg-white border-b border-slate-200
                   flex items-center justify-between px-4 lg:px-6 z-40">

        <div class="flex items-center gap-4 flex-1 max-w-xl">
            <button class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center
                           text-slate-600 hover:bg-slate-100"
                    onclick="toggleSidebar()">
                <span class="material-symbols-rounded">menu</span>
            </button>

            <div class="flex-1 relative">
                <div class="flex items-center gap-2 px-3 py-2 bg-slate-100 rounded-lg">
                    <span class="material-symbols-rounded text-slate-400 text-[20px]">search</span>
                    <input type="text" id="global-search" placeholder="Rechercher un formateur, un établissement..."
                           autocomplete="off"
                           class="bg-transparent border-none outline-none text-[13px]
                                  text-slate-700 w-full placeholder:text-slate-400">
                </div>

                <div id="search-results"
                     class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-xl
                            border border-slate-200 shadow-lg max-h-96 overflow-y-auto z-50">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="relative">
                <button onclick="toggleNotifications()"
                        class="relative w-9 h-9 rounded-lg flex items-center justify-center
                               text-slate-500 hover:bg-slate-100">
                    <span class="material-symbols-rounded">notifications</span>
                    <span id="notif-badge" class="hidden absolute top-1 right-1 min-w-[18px] h-[18px] px-1
                                                 bg-red-500 text-white text-[10px] font-bold
                                                 rounded-full flex items-center justify-center border-2 border-white">
                        0
                    </span>
                </button>

                <div id="notifications-dropdown"
                     class="hidden absolute right-0 mt-2 w-96 bg-white rounded-xl
                            border border-slate-200 shadow-xl z-50">
                    <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                        <h3 class="font-display font-bold text-slate-900 text-sm">Notifications</h3>
                        <button onclick="markAllAsRead()"
                                class="text-[11px] font-semibold text-brand-700 hover:text-brand-800">
                            Tout marquer comme lu
                        </button>
                    </div>
                    <div id="notifications-list" class="max-h-96 overflow-y-auto">
                        <div class="p-8 text-center text-slate-400 text-sm">Chargement...</div>
                    </div>
                    <div class="px-4 py-3 border-t border-slate-100 text-center">
                        <a href="{{ route('admin.notifications.index') }}"
                           class="text-[12px] font-semibold text-brand-700 hover:text-brand-800">
                            Voir toutes les notifications
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                <div class="text-right hidden sm:block">
                    <div class="text-[12px] font-semibold text-slate-800">
                        {{ $admin->prenom }} {{ $admin->nom }}
                    </div>
                    <div class="text-[10px] text-slate-500">Administrateur</div>
                </div>
                <div class="avatar avatar-sm bg-gradient-to-br from-brand-400 to-brand-600">
                    {{ $initials }}
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 px-4 lg:px-6 py-6">
        @yield('content')
    </main>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.toggle('hidden');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
    }

    let notifOpen = false;

    function toggleNotifications() {
        const dropdown = document.getElementById('notifications-dropdown');
        notifOpen = !notifOpen;

        if (notifOpen) {
            dropdown.classList.remove('hidden');
            chargerNotifications();
        } else {
            dropdown.classList.add('hidden');
        }
    }

    async function chargerNotifications() {
        try {
            const response = await fetch('{{ route("admin.notifications.index") }}', {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            const data = await response.json();

            const list = document.getElementById('notifications-list');
            const badge = document.getElementById('notif-badge');

            if (data.non_lues > 0) {
                badge.textContent = data.non_lues;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            if (data.notifications.length === 0) {
                list.innerHTML = '<div class="p-8 text-center text-slate-400 text-sm">Aucune notification</div>';
                return;
            }

            const icons = {
                'info':    { color: 'text-blue-600',    bg: 'bg-blue-50' },
                'success': { color: 'text-emerald-600', bg: 'bg-emerald-50' },
                'warning': { color: 'text-amber-600',   bg: 'bg-amber-50' },
                'danger':  { color: 'text-red-600',     bg: 'bg-red-50' },
            };

            list.innerHTML = data.notifications.map(n => {
                const style = icons[n.type] || icons.info;
                const luClass = n.lu ? 'opacity-50' : '';
                return `
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 cursor-pointer
                                border-b border-slate-50 last:border-0 ${luClass}"
                         onclick="ouvrirNotification(${n.id}, '${n.lien || ''}')">
                        <div class="w-8 h-8 rounded-lg ${style.bg} flex items-center justify-center shrink-0">
                            <span class="material-symbols-rounded ${style.color} text-[18px]">${n.icone}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-[13px] font-semibold text-slate-800 truncate">${n.titre}</div>
                            <div class="text-[12px] text-slate-500 mt-0.5 line-clamp-2">${n.message}</div>
                            <div class="text-[10px] text-slate-400 mt-1">${n.date}</div>
                        </div>
                    </div>
                `;
            }).join('');
        } catch (error) {
            console.error('Erreur chargement notifications:', error);
            document.getElementById('notifications-list').innerHTML =
                '<div class="p-8 text-center text-red-400 text-sm">Erreur de chargement</div>';
        }
    }

    async function ouvrirNotification(id, lien) {
        try {
            await fetch(`/admin/notifications/${id}/read`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
            if (lien) window.location.href = lien;
            else chargerNotifications();
        } catch (error) { console.error(error); }
    }

    async function markAllAsRead() {
        try {
            await fetch('{{ route("admin.notifications.read-all") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            });
            chargerNotifications();
        } catch (error) { console.error(error); }
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetch('{{ route("admin.notifications.index") }}', {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(r => r.json())
        .then(data => {
            const badge = document.getElementById('notif-badge');
            if (data.non_lues > 0) {
                badge.textContent = data.non_lues;
                badge.classList.remove('hidden');
            }
        })
        .catch(() => {});
    });

    document.addEventListener('click', (e) => {
        const notifBtn = document.querySelector('[onclick="toggleNotifications()"]');
        const notifDropdown = document.getElementById('notifications-dropdown');
        if (notifOpen && notifDropdown && notifBtn &&
            !notifDropdown.contains(e.target) && !notifBtn.contains(e.target)) {
            notifOpen = false;
            notifDropdown.classList.add('hidden');
        }
    });

    let searchTimeout;

    document.getElementById('global-search')?.addEventListener('input', function(e) {
        const term = e.target.value.trim();
        const results = document.getElementById('search-results');
        clearTimeout(searchTimeout);

        if (term.length < 2) { results.classList.add('hidden'); return; }

        searchTimeout = setTimeout(async () => {
            try {
                const response = await fetch(`{{ route("admin.search") }}?q=${encodeURIComponent(term)}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();

                if (data.length === 0) {
                    results.innerHTML = '<div class="p-4 text-center text-slate-400 text-sm">Aucun résultat</div>';
                } else {
                    const icons = { 'formateur': 'person', 'etablissement': 'apartment' };
                    results.innerHTML = data.map(item => `
                        <a href="${item.url}"
                           class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50
                                  border-b border-slate-50 last:border-0">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                                <span class="material-symbols-rounded text-slate-600 text-[18px]">${icons[item.type] || 'search'}</span>
                            </div>
                            <div class="text-[13px] text-slate-700">${item.label}</div>
                        </a>
                    `).join('');
                }
                results.classList.remove('hidden');
            } catch (error) { console.error('Erreur recherche:', error); }
        }, 300);
    });

    document.addEventListener('click', (e) => {
        const searchInput = document.getElementById('global-search');
        const searchResults = document.getElementById('search-results');
        if (searchInput && searchResults &&
            !searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
</script>
@stack('scripts')
</body>
</html>
```

## resources/views/layouts/app.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SGFORMATEURS') - SGFORMATEURS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <main>
        @yield('content')
    </main>
</body>
</html>
```

## resources/views/layouts/formateur.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Espace Formateur') — SGFORMATEURS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
</head>
<body class="font-sans bg-slate-50 text-slate-900 antialiased">

@php
    $formateur = Auth::guard('formateur')->user();
    $initials = strtoupper(
        substr($formateur->prenom ?? 'F', 0, 1) . substr($formateur->nom ?? 'M', 0, 1)
    );

    $menu = [
        [
            'route' => 'formateur.dashboard',
            'url'   => 'formateur.dashboard',
            'icon'  => 'home',
            'label' => 'Tableau de bord',
        ],
        ['section' => 'Mon activité'],
        [
            'route' => 'formateur.affectations.*',
            'url'   => 'formateur.affectations.index',
            'icon'  => 'assignment_ind',
            'label' => 'Mes affectations',
        ],
        [
            'route' => 'formateur.sessions.*',
            'url'   => 'formateur.sessions.index',
            'icon'  => 'event',
            'label' => 'Mes sessions',
        ],
        ['section' => 'Mon compte'],
        [
            'route' => 'formateur.profile.*',
            'url'   => 'formateur.profile.edit',
            'icon'  => 'person',
            'label' => 'Mon profil',
        ],
    ];
@endphp

{{-- ============== SIDEBAR ============== --}}
<aside id="sidebar"
       class="fixed top-0 left-0 h-screen w-64 bg-brand-900 flex flex-col z-50
              -translate-x-full lg:translate-x-0 transition-transform duration-300">

    <div class="flex items-center gap-3 px-6 h-16 border-b border-white/10">
        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
            <span class="material-symbols-rounded text-white text-2xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="flex flex-col leading-tight">
            <span class="font-display font-bold text-white text-sm">SGFORMATEURS</span>
            <span class="text-[10px] text-emerald-200/70">Espace Formateur</span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
        @foreach($menu as $item)
            @if(isset($item['section']))
                <div class="text-[10px] font-bold text-emerald-200/50 uppercase tracking-widest
                            px-3 pt-4 pb-2">
                    {{ $item['section'] }}
                </div>
            @else
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['url']) }}"
                   class="{{ $active ? 'sidebar-item-active' : 'sidebar-item-inactive' }}">
                    <span class="material-symbols-rounded text-[20px] shrink-0">
                        {{ $item['icon'] }}
                    </span>
                    <span class="flex-1">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <div class="p-3 border-t border-white/10">
        <div class="flex items-center gap-3 p-2.5 rounded-lg bg-white/5">
            <div class="avatar avatar-sm bg-gradient-to-br from-brand-400 to-brand-600">
                {{ $initials }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-semibold text-[12px] text-white truncate">
                    {{ $formateur->prenom }} {{ $formateur->nom }}
                </div>
                <div class="text-[10px] text-emerald-200/70">Formateur</div>
            </div>
            <form action="{{ route('formateur.logout') }}" method="POST">
                @csrf
                <button class="w-8 h-8 rounded-lg flex items-center justify-center
                               text-emerald-200/70 hover:bg-white/10 hover:text-white transition">
                    <span class="material-symbols-rounded text-[18px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden"
     onclick="closeSidebar()"></div>

{{-- ============== CONTENU ============== --}}
<div class="lg:ml-64 min-h-screen flex flex-col">

    {{-- Header --}}
    <header class="sticky top-0 h-16 bg-white border-b border-slate-200
                   flex items-center justify-between px-4 lg:px-6 z-40">

        <div class="flex items-center gap-4 flex-1 max-w-xl">
            <button class="lg:hidden w-9 h-9 rounded-lg flex items-center justify-center
                           text-slate-600 hover:bg-slate-100"
                    onclick="toggleSidebar()">
                <span class="material-symbols-rounded">menu</span>
            </button>

            <div class="hidden sm:flex items-center gap-2 text-slate-500 text-[13px]">
                <span class="material-symbols-rounded text-[18px]">calendar_today</span>
                <span>{{ now()->translatedFormat('l d F Y') }}</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                <div class="text-right hidden sm:block">
                    <div class="text-[12px] font-semibold text-slate-800">
                        {{ $formateur->prenom }} {{ $formateur->nom }}
                    </div>
                    <div class="text-[10px] text-slate-500">
                        {{ $formateur->matricule ?? 'Formateur' }}
                    </div>
                </div>
                <div class="avatar avatar-sm bg-gradient-to-br from-brand-400 to-brand-600">
                    {{ $initials }}
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 px-4 lg:px-6 py-6">
        @yield('content')
    </main>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.toggle('hidden');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
    }
</script>
@stack('scripts')
</body>
</html>
```

## resources/views/layouts/guest.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Connexion') — SGFORMATEURS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Space+Grotesk:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <style>
        @keyframes pulse-slow { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        .animate-pulse-slow { animation: pulse-slow 3s ease-in-out infinite; }
    </style>
</head>
<body class="font-sans min-h-screen flex items-center justify-center p-6 relative overflow-hidden bg-slate-950">
    <div class="fixed inset-0 z-0 bg-linear-to-br from-primary-900 via-primary-800 to-primary-700"></div>
    <div class="fixed inset-0 z-0 opacity-30" style="background-image: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.4) 0%, transparent 40%), radial-gradient(circle at 80% 70%, rgba(245, 158, 11, 0.2) 0%, transparent 40%);"></div>
    <div class="fixed inset-0 z-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 50px 50px;"></div>
    <div class="relative z-10 w-full flex items-center justify-center">
        @yield('content')
    </div>
</body>
</html>
```

## resources/views/layouts/navigation.blade.php

```blade
<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="material-symbols-outlined text-green-700">school</span>
            <span class="font-extrabold text-gray-800">SGFORMATEURS</span>
        </a>
        <div class="flex items-center gap-3">
            @auth('admin')
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-green-700">Dashboard Admin</a>
            @endauth
            @auth('formateur')
                <a href="{{ route('formateur.dashboard') }}" class="text-sm text-gray-600 hover:text-green-700">Dashboard Formateur</a>
            @endauth
        </div>
    </div>
</nav>
```

## resources/views/pdf/affectations/liste.blade.php

```blade
@extends('pdf.layouts.base')
@section('title', 'Liste des affectations')
@section('doc-title', 'LISTE DES AFFECTATIONS')
@section('doc-subtitle', 'Nombre total : ' . $affectations->count() . ' affectation(s)')

@section('content')
<table>
    <thead>
        <tr>
            <th style="width: 20%;">Formateur</th>
            <th style="width: 20%;">Filière</th>
            <th style="width: 20%;">Établissement</th>
            <th style="width: 13%;">Début</th>
            <th style="width: 13%;">Fin</th>
            <th style="width: 14%;">Statut</th>
        </tr>
    </thead>
    <tbody>
        @forelse($affectations as $a)
            <tr>
                <td>
                    <strong>{{ $a->formateur->nom ?? '-' }} {{ $a->formateur->prenom ?? '' }}</strong>
                    <br>
                    <span style="font-size:9px; color:#666;">{{ $a->formateur->matricule ?? '' }}</span>
                </td>
                <td>
                    <strong>{{ $a->filiere->code ?? '-' }}</strong>
                    <br>
                    <span style="font-size:9px;">{{ Str::limit($a->filiere->libelle ?? '', 35) }}</span>
                </td>
                <td>{{ $a->etablissement->nom ?? '-' }}</td>
                <td>{{ $a->date_debut?->format('d/m/Y') ?? '—' }}</td>
                <td>{{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                <td><span class="badge badge-{{ $a->statut }}">{{ ucfirst($a->statut) }}</span></td>
            </tr>
        @empty
            <tr><td colspan="6" class="no-data">Aucune affectation trouvée</td></tr>
        @endforelse
    </tbody>
</table>

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection
```

## resources/views/pdf/formateurs/fiche.blade.php

```blade
@extends('pdf.layouts.base')

@section('title', 'Fiche Formateur')
@section('doc-title', 'FICHE FORMATEUR')
@section('doc-subtitle', $formateur->matricule . ' — ' . $formateur->prenom . ' ' . $formateur->nom)

@section('content')

<div class="info-box">
    <h3>Informations personnelles</h3>
    <table>
        <tr>
            <td style="width: 30%;"><strong>Matricule :</strong></td>
            <td>{{ $formateur->matricule ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Nom complet :</strong></td>
            <td>{{ $formateur->prenom ?? '' }} {{ $formateur->nom ?? '' }}</td>
        </tr>
        <tr>
            <td><strong>Email :</strong></td>
            <td>{{ $formateur->email ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Téléphone :</strong></td>
            <td>{{ $formateur->telephone ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>Statut :</strong></td>
            <td>
                <span class="badge badge-{{ $formateur->statut ?? 'actif' }}">
                    {{ ucfirst($formateur->statut ?? 'actif') }}
                </span>
            </td>
        </tr>
        <tr>
            <td><strong>Établissement :</strong></td>
            <td>{{ $formateur->etablissement->nom ?? '-' }}</td>
        </tr>
    </table>
</div>

@if($formateur->affectations && $formateur->affectations->count())
<div class="info-box">
    <h3>Affectations ({{ $formateur->affectations->count() }})</h3>
    <table>
        <thead>
            <tr>
                <th>Filière</th>
                <th>Établissement</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formateur->affectations as $a)
                <tr>
                    <td>{{ $a->filiere->libelle ?? '-' }}</td>
                    <td>{{ $a->etablissement->nom ?? '-' }}</td>
                    <td>{{ $a->date_debut?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $a->date_fin?->format('d/m/Y') ?? 'En cours' }}</td>
                    <td>
                        <span class="badge badge-{{ $a->statut ?? 'actif' }}">
                            {{ ucfirst($a->statut ?? 'actif') }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
```

## resources/views/pdf/formateurs/liste.blade.php

```blade
@extends('pdf.layouts.base')
@section('title', 'Liste des formateurs')
@section('doc-title', 'LISTE DES FORMATEURS')
@section('doc-subtitle', 'Nombre total : ' . $formateurs->count() . ' formateur(s)')

@section('content')
<table>
    <thead>
        <tr>
            <th style="width: 12%;">Matricule</th>
            <th style="width: 22%;">Nom complet</th>
            <th style="width: 22%;">Email</th>
            <th style="width: 12%;">Téléphone</th>
            <th style="width: 20%;">Établissement</th>
            <th style="width: 12%;">Grade</th>
        </tr>
    </thead>
    <tbody>
        @forelse($formateurs as $f)
            <tr>
                <td><strong>{{ $f->matricule ?? '-' }}</strong></td>
                <td>{{ $f->prenom ?? '' }} {{ $f->nom ?? '' }}</td>
                <td>{{ $f->email ?? '-' }}</td>
                <td>{{ $f->telephone ?? '-' }}</td>
                <td>{{ $f->etablissement->nom ?? '-' }}</td>
                <td>{{ $f->grade ?? '—' }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="no-data">Aucun formateur trouvé</td></tr>
        @endforelse
    </tbody>
</table>

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection
```

## resources/views/pdf/formateurs/par-etablissement.blade.php

```blade
@extends('pdf.layouts.base')
@section('title', 'Formateurs par établissement')
@section('doc-title', 'FORMATEURS PAR ÉTABLISSEMENT')
@section('doc-subtitle', 'Nombre total : ' . $etablissements->count() . ' établissement(s)')

@section('content')

@forelse($etablissements as $etablissement)
    <div class="info-box">
        <h3>{{ $etablissement->nom }} — ({{ $etablissement->code }})</h3>
        <table>
            <tr>
                <td style="width: 25%;"><strong>Type :</strong></td>
                <td>{{ $etablissement->type ?? '—' }}</td>
                <td style="width: 25%;"><strong>Région :</strong></td>
                <td>{{ $etablissement->region ?? '—' }}</td>
            </tr>
            <tr>
                <td><strong>Contact Responsable :</strong></td>
                <td colspan="3">
                    {{ $etablissement->contact_responsable ?? $etablissement->telephone ?? '—' }}
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Matricule</th>
                <th style="width: 28%;">Nom complet</th>
                <th style="width: 22%;">Email</th>
                <th style="width: 20%;">Grade</th>
                <th style="width: 10%;">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($etablissement->formateurs as $i => $f)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $f->matricule }}</strong></td>
                    <td>{{ $f->prenom }} {{ $f->nom }}</td>
                    <td>{{ $f->email ?? '—' }}</td>
                    <td>{{ $f->grade ?? '—' }}</td>
                    <td><span class="badge badge-{{ $f->statut }}">{{ ucfirst($f->statut) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="no-data">Aucun formateur rattaché à cet établissement</td></tr>
            @endforelse
        </tbody>
    </table>
    <p style="font-size: 10px; color: #666; margin-bottom: 20px;">
        <strong>Total :</strong> {{ $etablissement->formateurs->count() }} formateur(s)
    </p>
@empty
    <div class="no-data">Aucun établissement trouvé</div>
@endforelse

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection
```

## resources/views/pdf/formateurs/par-filiere.blade.php

```blade
@extends('pdf.layouts.base')
@section('title', 'Formateurs par filière')
@section('doc-title', 'FORMATEURS PAR FILIÈRE')
@section('doc-subtitle', 'Nombre total : ' . $filieres->count() . ' filière(s)')

@section('content')

@forelse($filieres as $filiere)
    <div class="info-box">
        <h3>{{ $filiere->libelle }} — ({{ $filiere->code }})</h3>
        @if($filiere->description)
            <p style="font-size: 10px; color: #666; margin-top: 4px;">
                {{ Str::limit($filiere->description, 120) }}
            </p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 15%;">Matricule</th>
                <th style="width: 30%;">Nom complet</th>
                <th style="width: 25%;">Email</th>
                <th style="width: 15%;">Établissement</th>
                <th style="width: 10%;">Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($filiere->formateurs as $i => $f)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $f->matricule }}</strong></td>
                    <td>{{ $f->prenom }} {{ $f->nom }}</td>
                    <td>{{ $f->email ?? '—' }}</td>
                    <td>{{ $f->etablissement->nom ?? '—' }}</td>
                    <td><span class="badge badge-{{ $f->statut }}">{{ ucfirst($f->statut) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="no-data">Aucun formateur rattaché à cette filière</td></tr>
            @endforelse
        </tbody>
    </table>
    <p style="font-size: 10px; color: #666; margin-bottom: 20px;">
        <strong>Total :</strong> {{ $filiere->formateurs->count() }} formateur(s)
    </p>
@empty
    <div class="no-data">Aucune filière trouvée</div>
@endforelse

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection
```

## resources/views/pdf/layouts/base.blade.php

```blade
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Document') - SGFormateurs</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; padding: 20px 25px; line-height: 1.4; }

        .header { border-bottom: 3px solid #047857; padding-bottom: 12px; margin-bottom: 18px; }
        .header table { width: 100%; border: none; }
        .header table td { border: none; padding: 0; vertical-align: top; }
        .header h1 { color: #047857; font-size: 22px; font-weight: bold; margin-bottom: 4px; letter-spacing: 0.5px; }
        .header h2 { color: #555; font-size: 11px; font-weight: normal; line-height: 1.4; }
        .header .logo { text-align: right; font-size: 9px; color: #666; line-height: 1.5; }
        .header .logo strong { color: #047857; font-size: 11px; display: block; margin-bottom: 2px; }

        .doc-title { text-align: center; margin: 20px 0; padding: 12px; background: #f3f4f6; border-left: 4px solid #047857; border-radius: 3px; }
        .doc-title h3 { color: #047857; font-size: 16px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: bold; }
        .doc-title p { color: #666; font-size: 10px; margin-top: 5px; font-style: italic; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        table thead { background: #047857; color: white; }
        table thead th { padding: 8px 6px; text-align: left; font-size: 9.5px; text-transform: uppercase; letter-spacing: 0.5px; font-weight: bold; border: 1px solid #047857; }
        table tbody td { padding: 6px; border: 1px solid #ddd; font-size: 10px; vertical-align: top; }
        table tbody tr:nth-child(even) { background: #f9fafb; }

        .badge { display: inline-block; padding: 2px 7px; border-radius: 3px; font-size: 9px; font-weight: bold; text-transform: uppercase; }
        .badge-actif { background: #d1fae5; color: #065f46; }
        .badge-inactif { background: #e5e7eb; color: #374151; }
        .badge-en_attente { background: #fef3c7; color: #92400e; }
        .badge-present { background: #d1fae5; color: #065f46; }
        .badge-absent { background: #fee2e2; color: #991b1b; }
        .badge-retard { background: #fef3c7; color: #92400e; }
        .badge-excuse { background: #e5e7eb; color: #374151; }
        .badge-termine { background: #e5e7eb; color: #374151; }
        .badge-suspendu { background: #fee2e2; color: #991b1b; }

        .info-box { background: #f3f4f6; padding: 12px 15px; border-radius: 5px; border-left: 4px solid #047857; margin-bottom: 15px; }
        .info-box h3 { color: #047857; font-size: 13px; margin-bottom: 8px; font-weight: bold; }
        .info-box p { margin-bottom: 4px; font-size: 10.5px; line-height: 1.5; }
        .info-box strong { color: #047857; }
        .info-box table { margin: 0; }
        .info-box table td { border: none; padding: 3px 0; background: transparent !important; font-size: 10.5px; }

        .stats { width: 100%; margin-bottom: 18px; }
        .stats table { width: 100%; border: none; margin: 0; }
        .stats table td { border: none; padding: 0 5px; background: transparent !important; }
        .stat-card { background: #f3f4f6; padding: 12px 8px; border-radius: 5px; text-align: center; border-left: 3px solid #047857; }
        .stat-card .value { font-size: 20px; font-weight: bold; color: #047857; display: block; line-height: 1.2; }
        .stat-card .label { font-size: 9px; color: #666; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-top: 4px; }

        .footer { position: fixed; bottom: -10px; left: 0; right: 0; border-top: 1px solid #ddd; padding: 8px 25px; font-size: 9px; color: #666; }
        .footer table { width: 100%; border: none; margin: 0; }
        .footer table td { border: none; padding: 0; background: transparent !important; font-size: 9px; color: #666; }

        .signatures { margin-top: 50px; width: 100%; }
        .signatures table { width: 100%; border: none; margin: 0; }
        .signatures table td { border: none; padding: 0 20px; background: transparent !important; vertical-align: top; width: 50%; }
        .signature-block { text-align: center; }
        .signature-block .title { font-size: 11px; font-weight: bold; margin-bottom: 50px; }
        .signature-block .line { border-top: 1px solid #333; padding-top: 5px; font-size: 9px; color: #666; font-style: italic; }

        .no-data { text-align: center; padding: 25px; color: #999; font-style: italic; background: #f9fafb; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 70%;">
                    <h1>SGFormateurs</h1>
                    <h2>Ministère de l'Enseignement Technique<br>et de la Formation Professionnelle</h2>
                </td>
                <td style="width: 30%;" class="logo">
                    <strong>METFP Madagascar</strong>
                    Généré le {{ now()->format('d/m/Y') }}<br>à {{ now()->format('H:i') }}
                </td>
            </tr>
        </table>
    </div>

    @hasSection('doc-title')
        <div class="doc-title">
            <h3>@yield('doc-title')</h3>
            @hasSection('doc-subtitle')<p>@yield('doc-subtitle')</p>@endif
        </div>
    @endif

    @yield('content')

    <div class="footer">
        <table>
            <tr>
                <td style="width: 70%;">SGFormateurs — Système de Gestion des Formateurs</td>
                <td style="width: 30%; text-align: right;">Document généré automatiquement</td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if (isset($pdf)) {
            $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
            $font = $fontMetrics->getFont("DejaVu Sans", "normal");
            $width = $fontMetrics->get_text_width($text, $font, 9);
            $pdf->page_text(($pdf->get_width() - $width) / 2, $pdf->get_height() - 30, $text, $font, 9, [0.4, 0.4, 0.4]);
        }
    </script>
</body>
</html>
```

## resources/views/pdf/statistiques/global.blade.php

```blade
@extends('pdf.layouts.base')
@section('title', 'Statistiques globales')
@section('doc-title', 'STATISTIQUES GLOBALES')
@section('doc-subtitle', 'Rapport généré le ' . now()->format('d/m/Y à H:i'))

@section('content')

{{-- ========== STATISTIQUES GÉNÉRALES ========== --}}
<div class="stats" style="margin-bottom: 20px;">
    <table>
        <tr>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_formateurs'] }}</span>
                    <span class="label">Formateurs</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_etablissements'] }}</span>
                    <span class="label">Établissements</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_filieres'] }}</span>
                    <span class="label">Filières</span>
                </div>
            </td>
            <td style="width: 25%;">
                <div class="stat-card">
                    <span class="value">{{ $stats['total_sessions'] }}</span>
                    <span class="label">Sessions</span>
                </div>
            </td>
        </tr>
    </table>
</div>

{{-- ========== FORMATEURS PAR STATUT ========== --}}
<div class="info-box">
    <h3>Répartition des formateurs par statut</h3>
    <table>
        <tr>
            <td style="width: 40%;"><strong>Actifs :</strong></td>
            <td>{{ $formateursParStatut['actif'] }}</td>
        </tr>
        <tr>
            <td><strong>Inactifs :</strong></td>
            <td>{{ $formateursParStatut['inactif'] }}</td>
        </tr>
        <tr>
            <td><strong>En attente :</strong></td>
            <td>{{ $formateursParStatut['en_attente'] }}</td>
        </tr>
    </table>
</div>

{{-- ========== AFFECTATIONS PAR STATUT ========== --}}
<div class="info-box">
    <h3>Répartition des affectations par statut</h3>
    <table>
        <tr>
            <td style="width: 40%;"><strong>Actives :</strong></td>
            <td>{{ $affectationsParStatut['actif'] }}</td>
        </tr>
        <tr>
            <td><strong>Terminées :</strong></td>
            <td>{{ $affectationsParStatut['termine'] }}</td>
        </tr>
        <tr>
            <td><strong>Suspendues :</strong></td>
            <td>{{ $affectationsParStatut['suspendu'] }}</td>
        </tr>
    </table>
</div>

{{-- ========== FORMATEURS PAR ÉTABLISSEMENT ========== --}}
<h3 style="color: #047857; font-size: 13px; margin: 20px 0 10px 0; font-weight: bold;">
    RÉPARTITION DES FORMATEURS PAR ÉTABLISSEMENT
</h3>

<table>
    <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 50%;">Établissement</th>
            <th style="width: 15%;">Type</th>
            <th style="width: 30%;">Nombre de formateurs</th>
        </tr>
    </thead>
    <tbody>
        @forelse($formateursParEtablissement as $i => $e)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td><strong>{{ $e->nom }}</strong> <span style="color: #666;">({{ $e->code }})</span></td>
                <td>{{ $e->type }}</td>
                <td style="text-align: center;">
                    <strong style="color: #047857; font-size: 12px;">{{ $e->formateurs_count }}</strong>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="no-data">Aucun établissement</td></tr>
        @endforelse
    </tbody>
</table>

<div class="signatures">
    <table>
        <tr>
            <td>
                <div class="signature-block">
                    <p class="title">Le Responsable</p>
                    <p class="line">Nom et signature</p>
                </div>
            </td>
        </tr>
    </table>
</div>

@endsection
```

## resources/views/welcome.blade.php

```blade
@extends('layouts.guest')

@section('title', 'Bienvenue')

@section('content')

{{-- ============ HEADER VISITEUR ============ --}}
<nav class="bg-white border-b border-slate-200 px-6 lg:px-12 h-16
            flex items-center justify-between sticky top-0 z-40">
    <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
        <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700
                    flex items-center justify-center">
            <span class="material-symbols-rounded text-white text-xl"
                  style="font-variation-settings: 'FILL' 1;">school</span>
        </div>
        <div class="flex flex-col leading-tight">
            <span class="font-display font-bold text-slate-900 text-sm">SGFORMATEURS</span>
            <span class="text-[10px] text-slate-500">Gestion des Formateurs</span>
        </div>
    </a>

    <div class="hidden md:flex items-center gap-6">
        <a href="#accueil" class="text-sm text-slate-600 hover:text-brand-700">Accueil</a>
        <a href="#a-propos" class="text-sm text-slate-600 hover:text-brand-700">À propos</a>
        <a href="#contact" class="text-sm text-slate-600 hover:text-brand-700">Contact</a>
    </div>

    <a href="{{ route('admin.login') }}" class="btn-primary btn-sm">Se connecter</a>
</nav>

{{-- ============ HERO ============ --}}
<section id="accueil" class="relative overflow-hidden">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center px-6 lg:px-12 py-16">

        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full
                        bg-brand-50 border border-brand-200 mb-4">
                <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                <span class="text-xs font-semibold text-brand-700">Nouveau</span>
            </div>

            <h1 class="font-display text-4xl lg:text-5xl font-bold text-slate-900 leading-tight">
                SGFORMATEURS
            </h1>
            <p class="text-xl text-slate-700 font-medium mt-4">
                Un outil au service du METFP
            </p>
            <p class="text-slate-500 mt-4 leading-relaxed">
                Centralisez, suivez et gérez tous les formateurs des centres de métiers
                et établissements de formation.
            </p>

            <div class="flex flex-wrap gap-3 mt-8">
                <a href="{{ route('admin.login') }}" class="btn-primary">
                    <span class="material-symbols-rounded text-[18px]">login</span>
                    Se connecter
                </a>
                <a href="#a-propos" class="btn-outline-primary">
                    En savoir plus
                </a>
            </div>
        </div>

        <div class="relative">
            <img src="https://images.unsplash.com/photo-1562774053-701939374585?w=800"
                 alt="Établissement"
                 class="rounded-2xl shadow-xl w-full h-96 object-cover">
        </div>
    </div>
</section>

{{-- ============ À PROPOS ============ --}}
<section id="a-propos" class="bg-white py-16 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="font-display text-3xl font-bold text-slate-900">À propos</h2>
            <p class="text-slate-500 mt-3">Une plateforme complète pour la gestion des formateurs</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">groups</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Gestion des formateurs</h3>
                <p class="text-sm text-slate-600">
                    Centralisez les informations de tous les formateurs du réseau.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">assignment_ind</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Suivi des affectations</h3>
                <p class="text-sm text-slate-600">
                    Gérez les affectations par filière et établissement.
                </p>
            </div>

            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center mb-4">
                    <span class="material-symbols-rounded text-brand-700 text-2xl">description</span>
                </div>
                <h3 class="font-display font-bold text-slate-900 mb-2">Rapports et statistiques</h3>
                <p class="text-sm text-slate-600">
                    Générez des rapports PDF et consultez les statistiques en temps réel.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============ CONTACT / CTA ============ --}}
<section id="contact" class="py-16 px-6 lg:px-12">
    <div class="max-w-4xl mx-auto bg-gradient-to-br from-brand-700 to-brand-900
                rounded-3xl p-12 text-center text-white shadow-2xl">
        <h2 class="font-display text-3xl font-bold">Prêt à commencer ?</h2>
        <p class="text-emerald-100 mt-3">Accédez à votre espace dès maintenant</p>
        <div class="flex justify-center gap-3 mt-8">
            <a href="{{ route('admin.login') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                      bg-white text-brand-800 font-semibold text-sm
                      hover:bg-slate-100 transition-all">
                <span class="material-symbols-rounded text-[18px]">login</span>
                Espace Admin
            </a>
            <a href="{{ route('formateur.login') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl
                      border-2 border-white text-white font-semibold text-sm
                      hover:bg-white hover:text-brand-800 transition-all">
                <span class="material-symbols-rounded text-[18px]">school</span>
                Espace Formateur
            </a>
        </div>
    </div>
</section>

{{-- ============ FOOTER ============ --}}
<footer class="bg-slate-900 text-slate-400 py-8 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                <span class="material-symbols-rounded text-white text-lg">school</span>
            </div>
            <span class="font-display font-bold text-white text-sm">SGFORMATEURS</span>
        </div>
        <p class="text-xs">© {{ date('Y') }} SGFORMATEURS — Tous droits réservés</p>
    </div>
</footer>

@endsection
```

## routes/admin.php

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FormateurController;
use App\Http\Controllers\Admin\EtablissementController;
use App\Http\Controllers\Admin\FiliereController;
use App\Http\Controllers\Admin\AffectationController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PdfController;

Route::middleware(['auth:admin', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('formateurs', FormateurController::class);
        Route::resource('etablissements', EtablissementController::class);
        Route::resource('filieres', FiliereController::class);
        Route::resource('affectations', AffectationController::class);

        Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/sessions/{id}', [SessionController::class, 'show'])->name('sessions.show');

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('mark-read');
            Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
            Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('destroy');
            Route::delete('/destroy-all', [NotificationController::class, 'destroyAll'])->name('destroy-all');
        });

        Route::resource('users', UserController::class);

        Route::prefix('pdf')->name('pdf.')->group(function () {
            Route::get('/', [PdfController::class, 'index'])->name('index');
            Route::get('/formateurs', [PdfController::class, 'formateurs'])->name('formateurs');
            Route::get('/formateurs/par-etablissement', [PdfController::class, 'formateursParEtablissement'])->name('formateurs.par-etablissement');
            Route::get('/formateurs/par-filiere', [PdfController::class, 'formateursParFiliere'])->name('formateurs.par-filiere');
            Route::get('/formateurs/{id}', [PdfController::class, 'formateur'])->where('id', '[0-9]+')->name('formateur');
            Route::get('/affectations', [PdfController::class, 'affectations'])->name('affectations');
            Route::get('/statistiques', [PdfController::class, 'statistiques'])->name('statistiques');
        });

        Route::get('/search', [DashboardController::class, 'search'])->name('search');
        Route::get('/formateurs-by-etablissement', [DashboardController::class, 'formateursByEtablissement'])->name('formateurs.by.etablissement');
    });
```

## routes/auth.php

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Auth\Admin\RegisterController as AdminRegister;
use App\Http\Controllers\Auth\Admin\LogoutController as AdminLogout;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController as AdminForgot;
use App\Http\Controllers\Auth\Admin\ResetPasswordController as AdminReset;
use App\Http\Controllers\Auth\Formateur\LoginController as FormateurLogin;
use App\Http\Controllers\Auth\Formateur\RegisterController as FormateurRegister;
use App\Http\Controllers\Auth\Formateur\LogoutController as FormateurLogout;
use App\Http\Controllers\Auth\Formateur\ForgotPasswordController as FormateurForgot;
use App\Http\Controllers\Auth\Formateur\ResetPasswordController as FormateurReset;

// ===== ADMIN =====
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest.admin')->group(function () {
        Route::get('/login', [AdminLogin::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLogin::class, 'login']);
        Route::get('/register', [AdminRegister::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AdminRegister::class, 'register']);

        Route::get('/forgot-password', [AdminForgot::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [AdminForgot::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [AdminReset::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [AdminReset::class, 'reset'])->name('password.update');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('/logout', [AdminLogout::class, 'logout'])->name('logout');
    });
});

// ===== FORMATEUR =====
Route::prefix('formateur')->name('formateur.')->group(function () {

    Route::middleware('guest.formateur')->group(function () {
        Route::get('/login', [FormateurLogin::class, 'showLoginForm'])->name('login');
        Route::post('/login', [FormateurLogin::class, 'login']);
        Route::get('/register', [FormateurRegister::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [FormateurRegister::class, 'register']);

        Route::get('/forgot-password', [FormateurForgot::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [FormateurForgot::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [FormateurReset::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [FormateurReset::class, 'reset'])->name('password.update');
    });

    Route::middleware('auth:formateur')->group(function () {
        Route::post('/logout', [FormateurLogout::class, 'logout'])->name('logout');
    });
});
```

## routes/console.php

```php
<?php

use Illuminate\Support\Facades\Schedule;

// Expiration auto des sessions — tous les jours à minuit
Schedule::command('sessions:expire')->daily();

// Ou toutes les heures pour plus de précision
// Schedule::command('sessions:expire')->hourly();
```

## routes/formateur.php

```php

```

## routes/web.php

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
```

## scripts/setup/snippets.md

```md
# Snippets du projet SGFormateurs

## FILE: app/Http/Controllers/Admin/FormateurController.php

```php
<?php

namespace App\Http\Controllers\Admin;

// ... le code du controller ...
```

## FILE: app/Http/Requests/Formateur/StoreFormateurRequest.php

```php
<?php

namespace App\Http\Requests\Formateur;

// ... le code du request ...
```

## FILE: resources/views/admin/formateurs/index.blade.php

```blade
@extends('layouts.admin')

@section('content')
    {{-- le code de la vue --}}
@endsection
```

## FILE: resources/views/admin/formateurs/partials/form.blade.php

```blade
{{-- le formulaire --}}
```
```

## tests/Feature/Admin/AllPagesTest.php

```php
<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Tests\TestCase;

class AllPagesTest extends TestCase
{
    use RefreshDatabase;

    private AdminModel $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = AdminModel::factory()->create();
    }

    private function checkPage(string $url): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get($url);
        $response->assertStatus(200);
    }

    public function test_dashboard(): void { $this->checkPage('/admin/dashboard'); }
    public function test_formateurs_index(): void { $this->checkPage('/admin/formateurs'); }
    public function test_formateurs_create(): void { $this->checkPage('/admin/formateurs/create'); }
    public function test_etablissements_index(): void { $this->checkPage('/admin/etablissements'); }
    public function test_etablissements_create(): void { $this->checkPage('/admin/etablissements/create'); }
    public function test_filieres_index(): void { $this->checkPage('/admin/filieres'); }
    public function test_filieres_create(): void { $this->checkPage('/admin/filieres/create'); }
    public function test_niveaux_index(): void { $this->checkPage('/admin/niveaux'); }
    public function test_niveaux_create(): void { $this->checkPage('/admin/niveaux/create'); }
    public function test_secteurs_index(): void { $this->checkPage('/admin/secteurs'); }
    public function test_secteurs_create(): void { $this->checkPage('/admin/secteurs/create'); }
    public function test_sessions_index(): void { $this->checkPage('/admin/sessions'); }
    public function test_sessions_create(): void { $this->checkPage('/admin/sessions/create'); }
    public function test_affectations_index(): void { $this->checkPage('/admin/affectations'); }
    public function test_affectations_create(): void { $this->checkPage('/admin/affectations/create'); }
    public function test_presences_index(): void { $this->checkPage('/admin/presences'); }
    public function test_presences_create(): void { $this->checkPage('/admin/presences/create'); }
    public function test_users_index(): void { $this->checkPage('/admin/users'); }
    public function test_users_create(): void { $this->checkPage('/admin/users/create'); }
}
```

## tests/Feature/Admin/FormateurControllerTest.php

```php
<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Tests\TestCase;

class FormateurControllerTest extends TestCase
{
    use RefreshDatabase;

    private AdminModel $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = AdminModel::factory()->create();
    }

    public function test_index_affiche_liste(): void
    {
        FormateurModel::factory()->count(3)->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->get('/admin/formateurs');

        $response->assertStatus(200);
        $response->assertViewHas('formateurs');
    }

    public function test_admin_peut_creer_formateur(): void
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->post('/admin/formateurs', [
                'matricule' => 'FORM-100',
                'nom' => 'Test',
                'prenom' => 'Jean',
                'email' => 'test@metfp.mg',
                'telephone' => '0341234567',
            ]);

        $response->assertRedirect('/admin/formateurs');
        $this->assertDatabaseHas('formateurs', ['matricule' => 'FORM-100']);
    }

    public function test_admin_peut_modifier_formateur(): void
    {
        $formateur = FormateurModel::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->put("/admin/formateurs/{$formateur->id}", [
                'nom' => 'Modifié',
                'prenom' => 'Test',
                'email' => $formateur->email,
                'telephone' => '0341234567',   // ⭐ AJOUT
                'statut' => 'actif',
            ]);

        $response->assertRedirect('/admin/formateurs');
        $this->assertDatabaseHas('formateurs', [
            'id' => $formateur->id,
            'nom' => 'Modifié',
        ]);
    }

    public function test_admin_peut_supprimer_formateur(): void
    {
        $formateur = FormateurModel::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->delete("/admin/formateurs/{$formateur->id}");

        $response->assertRedirect('/admin/formateurs');
        $this->assertSoftDeleted('formateurs', ['id' => $formateur->id]);
    }

    public function test_non_admin_ne_peut_pas_acceder(): void
    {
        $response = $this->get('/admin/formateurs');
        $response->assertRedirect('/admin/login');
    }
}
```

## tests/Feature/Auth/AdminAuthTest.php

```php
<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\AdminModel;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_login_admin_accessible(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_admin_peut_se_connecter(): void
    {
        $admin = AdminModel::factory()->create([
            'email' => 'admin@test.mg',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.mg',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_mauvais_mot_de_passe_rejete(): void
    {
        AdminModel::factory()->create([
            'email' => 'admin@test.mg',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.mg',
            'password' => 'mauvais',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest('admin');
    }

    public function test_admin_peut_se_deconnecter(): void
    {
        $admin = AdminModel::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest('admin');
    }
}
```

## tests/Feature/ExampleTest.php

```php
<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
```

## tests/Feature/Formateur/AllFormateurPagesTest.php

```php
<?php

namespace Tests\Feature\Formateur;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Persistence\Eloquent\Models\FormateurModel;
use Infrastructure\Persistence\Eloquent\Models\FormateurUserModel;
use Tests\TestCase;

class AllFormateurPagesTest extends TestCase
{
    use RefreshDatabase;

    private FormateurUserModel $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = FormateurUserModel::factory()->create([
            'matricule' => 'FORM-TEST',
            'email' => 'test@formateur.mg',
            'statut' => 'actif',
        ]);

        FormateurModel::factory()->create([
            'matricule' => $this->user->matricule,
            'email' => $this->user->email,
        ]);
    }

    private function checkPage(string $url): void
    {
        $response = $this->actingAs($this->user, 'formateur')->get($url);
        $response->assertStatus(200);
    }

    public function test_dashboard(): void { $this->checkPage('/formateur/dashboard'); }
    public function test_profile(): void { $this->checkPage('/formateur/profile'); }
    public function test_affectations(): void { $this->checkPage('/formateur/affectations'); }
    public function test_sessions(): void { $this->checkPage('/formateur/sessions'); }
    public function test_presences(): void { $this->checkPage('/formateur/presences'); }
    public function test_presences_create(): void { $this->checkPage('/formateur/presences/create'); }
}
```

## tests/TestCase.php

```php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //
}
```

## tests/Unit/Domain/Affectations/AffectationTest.php

```php
<?php

namespace Tests\Unit\Domain\Affectations;

use Domain\Affectations\Entities\Affectation;
use Tests\TestCase;

class AffectationTest extends TestCase
{
    public function test_est_active(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now(),
            statut: 'actif',
        );

        $this->assertTrue($affectation->estActive());
    }

    public function test_est_terminee(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now()->subMonths(6),
            dateFin: now(),
            statut: 'termine',
        );

        $this->assertTrue($affectation->estTerminee());
        $this->assertFalse($affectation->estActive());
    }

    public function test_calcul_duree(): void
    {
        $affectation = new Affectation(
            id: 1,
            formateurId: 1,
            filiereId: 1,
            etablissementId: 1,
            dateDebut: now(),
            dateFin: now()->addDays(30),
            statut: 'actif',
        );

        $this->assertEquals(30, $affectation->getDureeEnJours());
    }
}
```

## tests/Unit/Domain/Etablissements/EtablissementTest.php

```php
<?php

namespace Tests\Unit\Domain\Etablissements;

use Domain\Etablissements\Entities\Etablissement;
use Tests\TestCase;

class EtablissementTest extends TestCase
{
    public function test_get_nom_complet(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'CFP-AMBILOBE',
            nom: 'CFP AMBILOBE',
            type: 'CFP',
        );

        $this->assertEquals('CFP AMBILOBE', $etablissement->getNomComplet());
    }

    public function test_est_cfp(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'CFP-AMBILOBE',
            nom: 'CFP AMBILOBE',
            type: 'CFP',
        );

        $this->assertTrue($etablissement->estCFP());
        $this->assertFalse($etablissement->estLTP());
    }

    public function test_est_ltp(): void
    {
        $etablissement = new Etablissement(
            id: 1,
            code: 'LTP-MAHAMASINA',
            nom: 'LTP MAHAMASINA',
            type: 'LTP',
        );

        $this->assertTrue($etablissement->estLTP());
        $this->assertFalse($etablissement->estCFP());
    }
}
```

## tests/Unit/Domain/Filieres/FiliereTest.php

```php
<?php

namespace Tests\Unit\Domain\Filieres;

use Domain\Filieres\Entities\Filiere;
use Tests\TestCase;

class FiliereTest extends TestCase
{
    public function test_get_libelle_complet(): void
    {
        $filiere = new Filiere(
            id: 1,
            code: 'TPFM',
            libelle: 'Technicien productique en fabrication mécanique',
            niveauId: 1,
            secteurId: 1,
        );

        $this->assertEquals(
            'Technicien productique en fabrication mécanique',
            $filiere->getLibelleComplet()
        );
    }

    public function test_a_des_options(): void
    {
        $filiere = new Filiere(
            id: 1,
            code: 'TMEL',
            libelle: 'Technicien en électrotechnique',
            niveauId: 1,
            secteurId: 1,
            options: ['énergie renouvelable'],
        );

        $this->assertTrue($filiere->aDesOptions());
        $this->assertCount(1, $filiere->getOptions());
    }
}
```

## tests/Unit/Domain/Formateurs/Exceptions/FormateurInvalideExceptionTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\Exceptions;

use Domain\Formateurs\Exceptions\FormateurInvalideException;
use Tests\TestCase;

class FormateurInvalideExceptionTest extends TestCase
{
    public function test_email_invalide(): void
    {
        $e = FormateurInvalideException::emailInvalide('bad-email');
        $this->assertStringContainsString('bad-email', $e->getMessage());
    }

    public function test_matricule_invalide(): void
    {
        $e = FormateurInvalideException::matriculeInvalide('BAD');
        $this->assertStringContainsString('BAD', $e->getMessage());
        $this->assertStringContainsString('FORM-XXX', $e->getMessage());
    }

    public function test_nom_vide(): void
    {
        $e = FormateurInvalideException::nomVide();
        $this->assertStringContainsString('nom', $e->getMessage());
    }

    public function test_prenom_vide(): void
    {
        $e = FormateurInvalideException::prenomVide();
        $this->assertStringContainsString('prénom', $e->getMessage());
    }

    public function test_telephone_invalide(): void
    {
        $e = FormateurInvalideException::telephoneInvalide('123');
        $this->assertStringContainsString('123', $e->getMessage());
    }
}
```

## tests/Unit/Domain/Formateurs/FormateurTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs;

use Domain\Formateurs\Entities\Formateur;
use Tests\TestCase;

class FormateurTest extends TestCase
{
    public function test_get_nom_complet(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
        );

        $this->assertEquals('Rakoto Jean', $formateur->getNomComplet());
    }

    public function test_est_actif(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
            statut: 'actif',
        );

        $this->assertTrue($formateur->estActif());
    }

    public function test_est_inactif(): void
    {
        $formateur = new Formateur(
            id: 1,
            matricule: 'FORM-001',
            nom: 'Rakoto',
            prenom: 'Jean',
            email: 'jean@test.mg',
            statut: 'inactif',
        );

        $this->assertFalse($formateur->estActif());
    }
}
```

## tests/Unit/Domain/Formateurs/MatriculeTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs;

use Domain\Formateurs\ValueObjects\Matricule;
use InvalidArgumentException;
use Tests\TestCase;

class MatriculeTest extends TestCase
{
    public function test_matricule_valide(): void
    {
        $matricule = new Matricule('FORM-001');
        $this->assertEquals('FORM-001', $matricule->getValue());
    }

    public function test_matricule_converti_en_majuscules(): void
    {
        $matricule = new Matricule('form-001');
        $this->assertEquals('FORM-001', $matricule->getValue());
    }

    public function test_matricule_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Matricule('');
    }

    public function test_matricule_trop_long_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Matricule(str_repeat('A', 51));
    }
}
```

## tests/Unit/Domain/Formateurs/Rules/FormateurRulesTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\Rules;

use Domain\Formateurs\Rules\FormateurRules;
use Tests\TestCase;

class FormateurRulesTest extends TestCase
{
    // ===== MATRICULE =====
    public function test_matricule_valide(): void
    {
        $this->assertTrue(FormateurRules::validerMatricule('FORM-001'));
        $this->assertTrue(FormateurRules::validerMatricule('FORM-1234'));
    }

    public function test_matricule_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerMatricule('FORM-1'));
        $this->assertFalse(FormateurRules::validerMatricule('FORM'));
        $this->assertFalse(FormateurRules::validerMatricule('form-001'));
        $this->assertFalse(FormateurRules::validerMatricule(''));
    }

    // ===== EMAIL =====
    public function test_email_valide(): void
    {
        $this->assertTrue(FormateurRules::validerEmail('test@metfp.mg'));
        $this->assertTrue(FormateurRules::validerEmail('user.name@example.com'));
    }

    public function test_email_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerEmail('pas-un-email'));
        $this->assertFalse(FormateurRules::validerEmail('@example.com'));
        $this->assertFalse(FormateurRules::validerEmail(''));
    }

    // ===== TELEPHONE =====
    public function test_telephone_valide(): void
    {
        $this->assertTrue(FormateurRules::validerTelephone('0341234567'));
        $this->assertTrue(FormateurRules::validerTelephone('+261341234567'));
        $this->assertTrue(FormateurRules::validerTelephone(null));
        $this->assertTrue(FormateurRules::validerTelephone(''));
    }

    public function test_telephone_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerTelephone('123'));
    }

    // ===== STATUT =====
    public function test_statut_valide(): void
    {
        $this->assertTrue(FormateurRules::validerStatut('actif'));
        $this->assertTrue(FormateurRules::validerStatut('inactif'));
        $this->assertTrue(FormateurRules::validerStatut('en_attente'));
    }

    public function test_statut_invalide(): void
    {
        $this->assertFalse(FormateurRules::validerStatut('invalide'));
        $this->assertFalse(FormateurRules::validerStatut(''));
    }

    // ===== VALIDATION COMPLÈTE =====
    public function test_valider_retourne_vide_si_tout_ok(): void
    {
        $erreurs = FormateurRules::valider([
            'matricule' => 'FORM-001',
            'email' => 'test@metfp.mg',
            'nom' => 'Rakoto',
            'prenom' => 'Jean',
            'telephone' => '0341234567',
            'statut' => 'actif',
        ]);

        $this->assertEmpty($erreurs);
    }

    public function test_valider_retourne_erreurs(): void
    {
        $erreurs = FormateurRules::valider([
            'matricule' => 'BAD',
            'email' => 'pas-un-email',
            'nom' => '',
        ]);

        $this->assertArrayHasKey('matricule', $erreurs);
        $this->assertArrayHasKey('email', $erreurs);
        $this->assertArrayHasKey('nom', $erreurs);
    }
}
```

## tests/Unit/Domain/Formateurs/ValueObjects/EmailTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Email;
use InvalidArgumentException;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function test_email_valide(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_converti_en_minuscules(): void
    {
        $email = new Email('TEST@METFP.MG');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_espaces_supprimes(): void
    {
        $email = new Email('  test@metfp.mg  ');
        $this->assertEquals('test@metfp.mg', $email->getValue());
    }

    public function test_email_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('');
    }

    public function test_email_invalide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('pas-un-email');
    }

    public function test_get_domain(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('metfp.mg', $email->getDomain());
    }

    public function test_equals(): void
    {
        $email1 = new Email('test@metfp.mg');
        $email2 = new Email('test@metfp.mg');
        $email3 = new Email('autre@metfp.mg');

        $this->assertTrue($email1->equals($email2));
        $this->assertFalse($email1->equals($email3));
    }

    public function test_tostring(): void
    {
        $email = new Email('test@metfp.mg');
        $this->assertEquals('test@metfp.mg', (string) $email);
    }
}
```

## tests/Unit/Domain/Formateurs/ValueObjects/NomCompletTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\NomComplet;
use InvalidArgumentException;
use Tests\TestCase;

class NomCompletTest extends TestCase
{
    public function test_nom_complet_valide(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('Rakoto', $nc->getNom());
        $this->assertEquals('Jean', $nc->getPrenom());
    }

    public function test_format_prenom_nom(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('Jean Rakoto', $nc->getFormatted());
    }

    public function test_format_nom_majuscule(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('RAKOTO Jean', $nc->getFormattedAvecNomMajuscule());
    }

    public function test_initiales(): void
    {
        $nc = new NomComplet('Rakoto', 'Jean');
        $this->assertEquals('JR', $nc->getInitiales());
    }

    public function test_ucfirst(): void
    {
        $nc = new NomComplet('RAKOTO', 'JEAN');
        $this->assertEquals('Rakoto', $nc->getNom());
        $this->assertEquals('Jean', $nc->getPrenom());
    }

    public function test_nom_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NomComplet('', 'Jean');
    }

    public function test_prenom_vide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new NomComplet('Rakoto', '');
    }

    public function test_equals(): void
    {
        $a = new NomComplet('Rakoto', 'Jean');
        $b = new NomComplet('Rakoto', 'Jean');
        $c = new NomComplet('Rasoa', 'Marie');

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
    }
}
```

## tests/Unit/Domain/Formateurs/ValueObjects/StatutTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Statut;
use InvalidArgumentException;
use Tests\TestCase;

class StatutTest extends TestCase
{
    public function test_statut_actif(): void
    {
        $statut = new Statut('actif');
        $this->assertTrue($statut->estActif());
        $this->assertFalse($statut->estInactif());
        $this->assertFalse($statut->estEnAttente());
    }

    public function test_statut_inactif(): void
    {
        $statut = new Statut('inactif');
        $this->assertTrue($statut->estInactif());
    }

    public function test_statut_en_attente(): void
    {
        $statut = new Statut('en_attente');
        $this->assertTrue($statut->estEnAttente());
    }

    public function test_statut_invalide_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Statut('invalide');
    }

    public function test_constructeurs_statiques(): void
    {
        $this->assertTrue(Statut::actif()->estActif());
        $this->assertTrue(Statut::inactif()->estInactif());
        $this->assertTrue(Statut::enAttente()->estEnAttente());
    }

    public function test_get_label(): void
    {
        $this->assertEquals('Actif', Statut::actif()->getLabel());
        $this->assertEquals('Inactif', Statut::inactif()->getLabel());
        $this->assertEquals('En attente', Statut::enAttente()->getLabel());
    }
}
```

## tests/Unit/Domain/Formateurs/ValueObjects/TelephoneTest.php

```php
<?php

namespace Tests\Unit\Domain\Formateurs\ValueObjects;

use Domain\Formateurs\ValueObjects\Telephone;
use InvalidArgumentException;
use Tests\TestCase;

class TelephoneTest extends TestCase
{
    public function test_telephone_valide(): void
    {
        $tel = new Telephone('0341234567');
        $this->assertEquals('0341234567', $tel->getValue());
    }

    public function test_telephone_avec_espaces(): void
    {
        $tel = new Telephone('034 12 345 67');
        $this->assertEquals('0341234567', $tel->getValue());
    }

    public function test_telephone_avec_indicatif(): void
    {
        $tel = new Telephone('+261341234567');
        $this->assertEquals('+261341234567', $tel->getValue());
    }

    public function test_telephone_null(): void
    {
        $tel = new Telephone(null);
        $this->assertTrue($tel->isNull());
        $this->assertNull($tel->getValue());
    }

    public function test_telephone_vide_null(): void
    {
        $tel = new Telephone('');
        $this->assertTrue($tel->isNull());
    }

    public function test_telephone_trop_court_leve_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Telephone('123');
    }

    public function test_format_madagascar(): void
    {
        $tel = new Telephone('0341234567');
        $this->assertEquals('034 12 345 67', $tel->getFormatted());
    }
}
```

## tests/Unit/Domain/Niveaux/NiveauTest.php

```php
<?php

namespace Tests\Unit\Domain\Niveaux;

use Domain\Niveaux\Entities\Niveau;
use Tests\TestCase;

class NiveauTest extends TestCase
{
    public function test_code_valide(): void
    {
        $niveau = new Niveau(
            id: 1,
            code: 'BAC',
            libelle: 'Baccalauréat Technologique',
        );

        $this->assertEquals('BAC', $niveau->getCode());
    }

    public function test_est_bac(): void
    {
        $niveau = new Niveau(id: 1, code: 'BAC', libelle: 'Baccalauréat');
        $this->assertTrue($niveau->estBac());
    }

    public function test_est_cap(): void
    {
        $niveau = new Niveau(id: 3, code: 'CAP', libelle: 'CAP');
        $this->assertTrue($niveau->estCap());
        $this->assertFalse($niveau->estBac());
    }
}
```

## tests/Unit/Domain/Secteurs/SecteurTest.php

```php
<?php

namespace Tests\Unit\Domain\Secteurs;

use Domain\Secteurs\Entities\Secteur;
use Tests\TestCase;

class SecteurTest extends TestCase
{
    public function test_code_valide(): void
    {
        $secteur = new Secteur(
            id: 1,
            code: 'IND',
            libelle: 'INDUSTRIEL',
        );

        $this->assertEquals('IND', $secteur->getCode());
        $this->assertEquals('INDUSTRIEL', $secteur->getLibelle());
    }

    public function test_est_industriel(): void
    {
        $secteur = new Secteur(id: 1, code: 'IND', libelle: 'INDUSTRIEL');
        $this->assertTrue($secteur->estIndustriel());
    }
}
```

## tests/Unit/Domain/Sessions/SessionTest.php

```php
<?php

namespace Tests\Unit\Domain\Sessions;

use Domain\Sessions\Entities\Session;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function test_code_valide(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-2026-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now(),
            dateFin: now()->addMonths(3),
            nbPlaces: 20,
        );

        $this->assertEquals('SESS-2026-001', $session->getCode());
    }

    public function test_est_en_cours(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now()->subDays(15),
            dateFin: now()->addDays(15),
            nbPlaces: 20,
        );

        $this->assertTrue($session->estEnCours());
    }

    public function test_est_terminee(): void
    {
        $session = new Session(
            id: 1,
            code: 'SESS-001',
            filiereId: 1,
            formateurId: 1,
            etablissementId: 1,
            dateDebut: now()->subMonths(3),
            dateFin: now()->subDays(1),
            nbPlaces: 20,
        );

        $this->assertTrue($session->estTerminee());
    }
}
```

## tests/Unit/ExampleTest.php

```php
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
```

## vite.config.js

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
```

