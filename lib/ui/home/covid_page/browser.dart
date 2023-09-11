import 'dart:collection';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import 'package:url_launcher/url_launcher.dart';

class Covid19BrowserView extends StatefulWidget {
  final String covidPageUrl;
  const Covid19BrowserView({super.key, required this.covidPageUrl});

  @override
  Covid19BrowserViewState createState() => Covid19BrowserViewState();
}

class Covid19BrowserViewState extends State<Covid19BrowserView> {
  final GlobalKey webViewKey = GlobalKey();

  InAppWebViewController? webViewController;

  PullToRefreshController? pullToRefreshController;

  late ContextMenu contextMenu;
  String url = "";
  double progress = 0;
  final urlController = TextEditingController();

  Color btnColor = const Color.fromRGBO(181, 226, 85, 0.71);

  @override
  void initState() {
    super.initState();

    contextMenu = ContextMenu(
        menuItems: [
          ContextMenuItem(
              androidId: 1,
              title: "Special",
              action: () async {
                if (kDebugMode) {
                  print("Menu item Special clicked!");
                  print(await webViewController?.getSelectedText());
                }
                await webViewController?.clearFocus();
              })
        ],
        // settings: ContextMenuSettings(hideDefaultSystemContextMenuItems: false),
        onCreateContextMenu: (hitTestResult) async {
          if (kDebugMode) {
            print("onCreateContextMenu");
            print(hitTestResult.extra);
            print(await webViewController?.getSelectedText());
          }
        },
        onHideContextMenu: () {
          if (kDebugMode) {
            print("onHideContextMenu");
          }
        },
        onContextMenuActionItemClicked: (contextMenuItemClicked) async {
          var id = contextMenuItemClicked.androidId;
          if (kDebugMode) {
            print(
                "onContextMenuActionItemClicked: $id ${contextMenuItemClicked.title}");
          }
        });

    pullToRefreshController = kIsWeb ||
            ![TargetPlatform.iOS, TargetPlatform.android]
                .contains(defaultTargetPlatform)
        ? null
        : PullToRefreshController(
            options: PullToRefreshOptions(
              color: Colors.blue,
            ),
            onRefresh: () async {
              if (defaultTargetPlatform == TargetPlatform.android) {
                webViewController?.reload();
              } else if (defaultTargetPlatform == TargetPlatform.iOS ||
                  defaultTargetPlatform == TargetPlatform.macOS) {
                webViewController?.loadUrl(
                    urlRequest:
                        URLRequest(url: await webViewController?.getUrl()));
              }
            },
          );
  }

  @override
  void dispose() {
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        Container(),
        Expanded(
          child: Stack(
            children: [
              InAppWebView(
                key: webViewKey,
                initialUrlRequest:
                    URLRequest(url: Uri.parse(widget.covidPageUrl)),
                initialUserScripts: UnmodifiableListView<UserScript>([]),
                contextMenu: contextMenu,
                pullToRefreshController: pullToRefreshController,
                onWebViewCreated: (controller) async {
                  webViewController = controller;
                },
                onLoadStart: (controller, url) async {
                  setState(() {
                    this.url = url.toString();
                    urlController.text = this.url;
                  });
                },
                shouldOverrideUrlLoading: (controller, navigationAction) async {
                  var uri = navigationAction.request.url!;

                  if (![
                    "http",
                    "https",
                    "file",
                    "chrome",
                    "data",
                    "javascript",
                    "about"
                  ].contains(uri.scheme)) {
                    if (await canLaunchUrl(uri)) {
                      // Launch the App
                      await launchUrl(
                        uri,
                      );
                      // and cancel the request
                      return NavigationActionPolicy.CANCEL;
                    }
                  }

                  return NavigationActionPolicy.ALLOW;
                },
                onLoadStop: (controller, url) async {
                  pullToRefreshController?.endRefreshing();
                  setState(() {
                    this.url = url.toString();
                    urlController.text = this.url;
                  });
                },
                // onReceivedError: (controller, request, error) {
                //   pullToRefreshController?.endRefreshing();
                // },
                onLoadError: (controller, url, code, message) {
                  pullToRefreshController?.endRefreshing();
                },
                onProgressChanged: (controller, progress) {
                  if (progress == 100) {
                    pullToRefreshController?.endRefreshing();
                  }
                  setState(() {
                    this.progress = progress / 100;
                    urlController.text = url;
                  });
                },
                onUpdateVisitedHistory: (controller, url, isReload) {
                  setState(() {
                    this.url = url.toString();
                    urlController.text = this.url;
                  });
                },
                onConsoleMessage: (controller, consoleMessage) {
                  if (kDebugMode) {
                    print(consoleMessage);
                  }
                },
              ),
              progress < 1.0
                  ? LinearProgressIndicator(value: progress)
                  : Container(),
            ],
          ),
        ),
        ButtonBar(
          alignment: MainAxisAlignment.center,
          children: <Widget>[
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: btnColor,
              ),
              onPressed: () {
                webViewController?.goBack();
              },
              child: const Icon(Icons.arrow_back),
            ),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: btnColor,
              ),
              child: const Icon(Icons.arrow_forward),
              onPressed: () {
                webViewController?.goForward();
              },
            ),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: btnColor,
              ),
              child: const Icon(Icons.refresh),
              onPressed: () {
                webViewController?.reload();
              },
            ),
          ],
        ),
      ],
    );
  }
}
